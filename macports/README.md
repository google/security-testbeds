# OSV-Scalibr: MacPorts Extractor

This directory contains the test Dockerfile for testing OSV-Scalibr MacPorts Extractor plugin. MacPorts is an alternative package manager in OSX systems. It stores Portfiles under the /opt/local/var/macports/registry/portfiles/ for each installed packages. This plugin enumerates folder paths under this directory to extract version, revision and name attributes of installed packages.

## Setup

```sh
docker build -t macports-test .
docker run -it --rm -v $(pwd):/app macports-test (to put scalibr binary inside the container)
```
