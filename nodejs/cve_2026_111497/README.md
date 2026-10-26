# Node.js + Express Brotli Decoder Out-of-Bounds Write (CVE-2026-111497)

This directory provides both a **vulnerable** (`Dockerfile`) and a **patched**
(`Dockerfile.patched`) Node.js + Express testbed for verifying the Tsunami
`Cve2026111497Detector` plugin and validating that it produces zero false
positives and zero side effects.

## Background

**CVE-2026-111497** is an out-of-bounds write vulnerability in the native C
Brotli decoder (`libbrotlidec` `1.0.3` through `1.2.0`, bundled in Node.js `<=
22.22.0`, `<= 24.13.0`, and `<= 25.6.0`). When a compressed metablock declares
a single distance block type (`NBLTYPESD == 1`), `s->block_length[2]` is
initialized to `1 << 24` (`16,777,216`). If the metablock executes more than
`16,777,216` commands with explicit distances, `s->block_length[2]` reaches `0`
and invokes `DecodeDistanceBlockSwitch`. Unpatched Brotli returns
`BROTLI_FALSE` (`0`) when `max_block_type <= 1`:

* **Unpatched Brotli (`1.0.3 .. 1.2.0`)**: On the fast path (`safe == 0`),
  `BROTLI_SAFE(DecodeDistanceBlockSwitch(s))` ignores the return value,
  underflows `s->block_length[2]` to `0xFFFFFFFF`, and continues decompressing
  a 32-byte zero-filled metadata metablock (which preserves `s->pos == 0`
  across arbitrary TCP chunk splits) followed by two split uncompressed
  metablocks (`"a":"tsunami_brotl` and `i_check_7f9a2b"}`), returning
  `BROTLI_DECODER_RESULT_SUCCESS` with valid JSON without corrupting any
  ringbuffer or allocator pointers.
* **Patched Brotli (`1.0.10`, `1.1.1`, `1.2.1`)**: Immediately aborts
  decompression at the `16,777,217`th explicit distance symbol with
  `BROTLI_DECODER_ERROR_FORMAT_BLOCK_SWITCH` (`-17`), causing Express
  `body-parser` to reject the request with HTTP `400 Bad Request`.

## Running the Vulnerable and Patched Containers Locally

Always bind the containers strictly to `127.0.0.1`:

```sh
# Build and start vuln (127.0.0.1:3000) and safe (127.0.0.1:3001)
docker compose up --build -d
```

Or using `docker build` / `docker run` directly:

```sh
# 1. Vulnerable container (Node.js 22.22.0 with unpatched Brotli 1.2.0)
docker build -t cve-2026-111497-vuln -f Dockerfile .
docker run --rm -d --name cve-2026-111497-vuln \
  -p 127.0.0.1:3000:3000 cve-2026-111497-vuln

# 2. Patched container (Node.js 22.23.4 with patched Brotli)
docker build -t cve-2026-111497-safe -f Dockerfile.patched .
docker run --rm -d --name cve-2026-111497-safe \
  -p 127.0.0.1:3001:3000 cve-2026-111497-safe
```

## Scanning with Tsunami

Scan the **vulnerable** container (expects `VULNERABILITY_VERIFIED` for
`CVE-2026-111497`):

```sh
blaze run //testing/security/scanner/tsunami/container:tsunami_cli -- \
  --ip-v4-target=127.0.0.1 \
  --port-ranges-target=3000 \
  --detectors-include=Cve2026111497Detector
```

Scan the **patched** container (expects `0` findings / no false positive):

```sh
blaze run //testing/security/scanner/tsunami/container:tsunami_cli -- \
  --ip-v4-target=127.0.0.1 \
  --port-ranges-target=3001 \
  --detectors-include=Cve2026111497Detector
```
