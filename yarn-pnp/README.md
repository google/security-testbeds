# OSV-SCALIBR Yarn Plug'n'Play Extractor Testbed

This directory provides a container image for end-to-end testing of the
OSV-SCALIBR `javascript/yarnpnp` filesystem extractor.

The image uses pinned Yarn and package versions to generate real Plug'n'Play
runtime data during the container build. It covers the inline formats produced
by Yarn 3 and Yarn 4 as well as Yarn 4's external `.pnp.data.json` format.

## Test projects

- `/testdata/yarn3-inline`
  - Yarn `3.8.7`
  - Inline `.pnp.cjs`
  - Direct dependencies: `is-number@7.0.0`, `left-pad@1.3.0`
- `/testdata/yarn4-inline`
  - Yarn `4.10.3`
  - Inline `.pnp.cjs`
  - Direct dependencies: `@babel/code-frame@7.24.7`, `lodash@4.17.21`
- `/testdata/yarn4-external`
  - Yarn `4.10.3`
  - External `.pnp.data.json` and loader `.pnp.cjs`
  - Direct dependency: `typescript@5.9.3`
  - Exercises Yarn's built-in patched npm reference

Committed lockfiles make the complete resolved dependency inventories
reproducible.

## Build the image

```bash
docker build -t yarn-pnp-test .
```

Podman can be used as a drop-in replacement:

```bash
podman build -t yarn-pnp-test .
```

## Run OSV-SCALIBR

First build a static Linux SCALIBR binary from the OSV-SCALIBR repository:

```bash
CGO_ENABLED=0 go build -o /absolute/path/to/scalibr ./binary/scalibr
```

From this testbed directory, scan all supported Plug'n'Play representations:

```bash
mkdir -p output
docker run --rm \
  -v /absolute/path/to/scalibr:/app/scalibr:ro \
  -v "$PWD/output:/output" \
  yarn-pnp-test \
  /app/scalibr \
    --extractors=javascript/yarnpnp \
    --root=/ \
    --result=/output/result.textproto \
    /testdata/yarn3-inline/.pnp.cjs \
    /testdata/yarn4-inline/.pnp.cjs \
    /testdata/yarn4-external/.pnp.cjs \
    /testdata/yarn4-external/.pnp.data.json
```

The result should contain 16 packages: the direct dependencies listed above
and the transitive dependencies from the Yarn 4 inline project.
`typescript@5.9.3` should be reported once from its patched npm reference.

## Inspect the generated files

```bash
docker run --rm yarn-pnp-test \
  ls -la /testdata/yarn3-inline /testdata/yarn4-inline /testdata/yarn4-external
```
