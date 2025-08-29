# OSV-Scalibr: Nimble Extractor

This directory contains the test Dockerfile for testing OSV-Scalibr Nimble Extractor plugin. Nimble is the package manager for modules written in Nim language. Nimble stores the metadata of installed packages under ~/.nimble/pkgs2 (or ~/.nimble/pkgs for older Nimble versions), with each package’s .nimble file located in its corresponding subdirectory. This plugin enumerates these paths to read .nimble files to extract packagename and version of installed packages.

## Setup

```sh
docker build -t nimble-test .
docker run -it --rm -v $(pwd):/app nimble-test (to put scalibr binary inside the container)
```
