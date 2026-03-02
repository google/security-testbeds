# OSV-Scalibr: BuildZigZon Package Extractor

This directory contains the test Dockerfile for testing OSV-Scalibr BuildZigZon Package Extractor plugin. Build.zig.zon files are used by the official Zig package manager for modules written in Zig language. Package Manager stores the metadata of installed or added packages for a project under this file, with each package’s dependencies and version information. This plugin enumerates these files in the filesystem to scan Zig artifacts or source code dependencies.

## Setup

```sh
docker build -t buildzigzon-test .
docker run -it --rm -v $(pwd):/app buildzigzon-test (to put scalibr binary inside the container)
```
