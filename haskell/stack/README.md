# OSV-Scalibr: Haskell Stack Extractor

This directory contains a test Dockerfile for validating OSV-Scalibr's Haskell Stack Extractor plugin.

## Setup

### Build the Docker Image

```bash
cd security-testbeds/haskell/stack
docker build -t haskell-stack-extractor-testbed .
```

### Run the Container

```bash
docker run -it --rm haskell-stack-extractor-testbed /bin/bash
```

### Running OSV-Scalibr

Build or copy the `scalibr` binary to the current directory, and inside the container, run `scalibr` with the haskell stack extractor:

```bash
./scalibr --extractors=haskell/stack --result=output.textproto .
```