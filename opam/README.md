# OSV-Scalibr: opam (OCaml) Extractor

This directory contains the test Docker setup for testing OSV-Scalibr's opam extractor plugin. opam is the package manager for OCaml and stores installed package entries in a default switch install file.

## Overview

The opam extractor enumerates installed OCaml packages by reading the default switch install file at:

```
~/.opam/default/.opam-switch/install
```

Each entry is in the format `package-name.version` (one per line).

## Test Data Contents

The testbed includes a sample install file with the following packages:

- `dune` v3.7.2
- `ocamlfind` v1.9.6
- `core_kernel` v0.15.1
- `cohttp-lwt` v6.0.0
- `ppx_deriving` v5.2.1

## Setup Instructions

### Build the Docker Image

```bash
cd security-testbeds/opam
docker build -t opam-test .
```

### Run the Container

```bash
docker run -it --rm -v $(pwd):/app opam-test
```

This will:
- Start an interactive bash session
- Mount the current directory as `/app` inside the container
- Allow you to place the `scalibr` binary in `/app` and run tests

### Running OSV-Scalibr (inside container)

1) Build or copy the `scalibr` binary to the current directory
2) Inside the container, run:

```bash
./scalibr --extractors=ocaml/opam --result=opam_output.textproto --root=/ home/test/.opam/default/.opam-switch/install
```

### Extracting Test Data to Host

If you want to run the extractor outside the container:

```bash
docker run --rm -v $(pwd)/extracted_testdata:/output opam-test cp -r /home/test/.opam /output/
```

Then on your host:

```bash
./scalibr --extractors=ocaml/opam --result=opam_output.textproto --root=$(pwd)/extracted_testdata .opam/default/.opam-switch/install
```
