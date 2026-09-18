# OSV-SCALIBR: MinimOS Ecosystem Mapping

This directory contains the test Dockerfile for the MinimOS ecosystem mapping in the
OSV-SCALIBR `os/apk` extractor
([google/osv-scalibr#2406](https://github.com/google/osv-scalibr/pull/2406), for
[issue #2202](https://github.com/google/osv-scalibr/issues/2202)).

MinimOS is a security-focused, minimal APK-based Linux distribution built by Minimus
for distroless container workloads. It publishes its own advisory feed with `MINI-`
prefixed advisories, ingested into OSV.dev as a first-class ecosystem.

`os/apk` already parsed MinimOS package databases correctly and already captured
`ID=minimos` from `/etc/os-release` into `apkmeta.Metadata.OSID`, but `MakeEcosystem`
had no branch for it, so the packages fell through to `EcosystemAlpine` and no
`MINI-*` advisory could ever match. The PURL was already `pkg:apk/minimos/<package>`,
because `Metadata.ToNamespace()` returns `OSID`, which is why the bug was invisible:
the output looked right.

## Why this is not a real MinimOS image

The real images live at `reg.mini.dev` and pull anonymously, but they are not usable
as a testbed:

1. Minimus is ceasing operations and turning `reg.mini.dev` off on **2026-10-22**,
   with its technology going to Echo, so anything pinned to that registry stops
   being buildable afterwards.
2. The published MinimOS images are hardened to zero known advisories, which is the
   entire point of the product. Scanning one confirms the ecosystem routing but
   leaves no advisory matches to look at.

MinimOS uses the same APK database format as Alpine, and the `ID` field in
`/etc/os-release` is the only thing that decides the ecosystem. So this testbed pins
an `alpine:3.10` base, which ships an APK database with genuinely outdated packages,
and writes the real MinimOS os-release over it. `/etc/alpine-release` is removed so
nothing else can be mistaken for an Alpine version signal. osv-scanner already uses
the same technique in `cmd/osv-scanner/scan/image/testdata/test-alpine.Dockerfile`.

Cross-scanner confirmation that `ID=minimos` is canonical: Anchore's Grype ships the
same mapping, with a fixture at `grype/distro/testdata/os/minimos/etc/os-release` and
a MinimOS distro type in `grype/distro/type.go`.

## Setup

```sh
docker build --platform linux/amd64 -t minimos-test .
docker run --rm -it --platform linux/amd64 -v /tmp/scalibr:/usr/bin/scalibr minimos-test
```

Or scan the exported image directly:

```sh
docker save minimos-test -o minimos-test.tar
scalibr scan --result=result.json minimos-test.tar
```

## Expected result

Before the fix, every package is reported under ecosystem `Alpine` and no `MINI-*`
advisory matches. After it, the same packages carry ecosystem `MinimOS`.

The APK database at `/lib/apk/db/installed` holds 14 packages. Real MinimOS images
keep theirs at `usr/lib/apk/db/installed`, which `os/apk` also accepts. The entries
that matter, with the `o:` origin field that OSV matching keys on:

```
busybox       1.30.1-r5    origin busybox
ssl_client    1.30.1-r5    origin busybox
libcrypto1.1  1.1.1k-r0    origin openssl
libssl1.1     1.1.1k-r0    origin openssl
zlib          1.2.11-r1    origin zlib
```

Counted against the OSV.dev MinimOS export
(`https://osv-vulnerabilities.storage.googleapis.com/MinimOS/all.zip`) on
2026-09-18, those origins carry 59 MinimOS advisory records: 51 under `openssl`,
6 under `busybox`, 2 under `zlib`. The exact number surfaced by a scan is a
version-comparison result, so treat 59 as the ceiling.

Examples, each with the upstream CVE it maps to:

- `MINI-3729-6w87-2929`, busybox, upstream `CVE-2025-60876`, fixed in `1.37.0-r7`
- `MINI-cgvf-3w8p-hxpg`, openssl, upstream `CVE-2026-45447`, heap use-after-free in
  `PKCS7_verify()`, CVSS 8.8, fixed in `3.5.7-r0`
- `MINI-6378-ggcg-mxf2`, openssl, upstream `CVE-2026-34182`, CMS AuthEnvelopedData
  processing may accept forged messages, CVSS 9.1, fixed in `3.5.7-r0`
