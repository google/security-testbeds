# OSV-SCALIBR Composer Installed Packages Extractor Testbed

This directory provides a container image for end-to-end testing of the
OSV-SCALIBR `php/composerinstalled` filesystem extractor.

The image uses pinned Composer versions and local path repositories to generate
real `vendor/composer/installed.json` files without depending on Packagist. It
covers both supported Composer file layouts and development dependency
classification.

## Test projects

- `/testdata/composer1`
  - Composer `1.10.27`
  - Legacy top-level package array
  - `acme/legacy-library` version `1.2.3`
- `/testdata/composer2`
  - Composer `2.8.12`
  - Current object format with `packages` and `dev-package-names`
  - Runtime package: `acme/runtime-library` version `2.4.0`
  - Development package: `acme/dev-tool` version `3.1.0`

Composer 1 is end-of-life, so its warning during the image build is expected.
It remains in this testbed because deployed applications can still contain the
legacy `installed.json` format.

## Build the image

```bash
docker build -t composer-installed-test .
```

Podman can be used as a drop-in replacement:

```bash
podman build -t composer-installed-test .
```

## Run OSV-SCALIBR

First build a static Linux SCALIBR binary from the OSV-SCALIBR repository:

```bash
CGO_ENABLED=0 go build -o /absolute/path/to/scalibr ./binary/scalibr
```

From this testbed directory, scan both generated inventory files:

```bash
mkdir -p output
docker run --rm \
  -v /absolute/path/to/scalibr:/app/scalibr:ro \
  -v "$PWD/output:/output" \
  composer-installed-test \
  /app/scalibr \
    --extractors=php/composerinstalled \
    --root=/ \
    --result=/output/result.textproto \
    /testdata/composer1/vendor/composer/installed.json \
    /testdata/composer2/vendor/composer/installed.json
```

The result should contain all three packages. `acme/dev-tool@3.1.0` should be
marked as a development dependency, while the other two packages should remain
production dependencies.

## Inspect the generated files

```bash
docker run --rm composer-installed-test \
  cat /testdata/composer1/vendor/composer/installed.json

docker run --rm composer-installed-test \
  cat /testdata/composer2/vendor/composer/installed.json
```
