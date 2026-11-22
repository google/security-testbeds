# OSV-Scalibr: Browser Extractor

This directory contains the test Dockerfile for testing OSV-Scalibr Browser Extractor plugin. It is the enhancement for the existing plugin to support Microsoft Edge and Mozilla Firefox extensions.

## Setup

```sh
docker build -t browser-extensions-test .
docker run -it --rm -v $(pwd):/app browser-extensions-test (to put scalibr binary inside the container)
```
