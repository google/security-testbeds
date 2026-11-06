# OSV-SCALIBR FreeBSD pkg Extractor Testbed

This directory provides a container image for end-to-end testing of the
OSV-SCALIBR `os/freebsd` filesystem extractor.

A Linux container cannot run the FreeBSD userland or package manager directly.
The image therefore creates the same package metadata files that FreeBSD `pkg`
uses on disk and provides FreeBSD values in `/etc/os-release`. This validates
the extractor against both supported inventory formats without requiring a
FreeBSD host.

## Test inventory

The image contains:

- `/var/db/pkg/local.sqlite`
  - `curl` version `8.4.0`, origin `ftp/curl`
  - `openssl` version `3.0.12`, origin `security/openssl`
- `/var/db/pkg/jq-1.7.1/+MANIFEST`
  - `jq` version `1.7.1`, origin `textproc/jq`
- `/etc/os-release`
  - `ID=freebsd`
  - `VERSION_ID=14.0`

All packages use the architecture `freebsd:14:x86:64`.

## Build the image

```bash
docker build -t freebsd-pkg-test .
```

Podman can be used as a drop-in replacement:

```bash
podman build -t freebsd-pkg-test .
```

## Run OSV-SCALIBR

First build a static Linux SCALIBR binary from the OSV-SCALIBR repository:

```bash
CGO_ENABLED=0 go build -o /absolute/path/to/scalibr ./binary/scalibr
```

From this testbed directory, scan both package metadata formats:

```bash
mkdir -p output
docker run --rm \
  -v /absolute/path/to/scalibr:/app/scalibr:ro \
  -v "$PWD/output:/output" \
  freebsd-pkg-test \
  /app/scalibr \
    --extractors=os/freebsd \
    --root=/ \
    --result=/output/result.textproto \
    /var/db/pkg/local.sqlite \
    /var/db/pkg/jq-1.7.1/+MANIFEST
```

The result should contain `curl`, `openssl`, and `jq` packages with FreeBSD
package URLs and the `FreeBSD:14.0` ecosystem.

## Inspect the generated metadata

```bash
docker run --rm freebsd-pkg-test \
  sqlite3 /var/db/pkg/local.sqlite \
  'SELECT origin, name, version, arch FROM packages;'

docker run --rm freebsd-pkg-test \
  cat /var/db/pkg/jq-1.7.1/+MANIFEST
```
