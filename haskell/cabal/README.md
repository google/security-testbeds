# OSV-Scalibr: Haskell Cabal Extractor

This directory contains a test Dockerfile for validating OSV-Scalibr's Haskell Cabal Extractor plugin.

## Setup

### Build the Docker Image

```bash
cd security-testbeds/haskell/cabal
docker build -t haskell-cabal-extractor-testbed .
```

### Run the Container

```bash
docker run -it --rm haskell-cabal-extractor-testbed /bin/bash
```

### Running OSV-Scalibr

Build or copy the `scalibr` binary to the current directory, and inside the container, run `scalibr` with the haskell cabal extractor:

```bash
./scalibr --extractors=haskell/cabal --result=output.textproto .
```
