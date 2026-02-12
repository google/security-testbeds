# OSV-Scalibr: Chocolatey Extractor

This directory contains the test Dockerfile for testing OSV-Scalibr Chocolatey Extractor plugin. Chocolatey is software management automation for Windows Systems. It stores .nuspec files under the C:\ProgramData\chocolatey\lib for each installed packages. This plugin enumerates folder paths under this directory to extract name, version and other metadata from .nuspec files.

## Setup

```sh
docker build -t chocolatey-test .
docker run -it --rm -v $(pwd):/app chocolatey-test (to put scalibr binary inside the container)
```
