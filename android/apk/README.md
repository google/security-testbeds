# OSV-Scalibr: Android Package Kit Extractor

This directory contains a test Dockerfile for validating OSV-Scalibr's Android Package Kit Extractor plugin.

## Setup

### Build the Docker Image

```bash
cd security-testbeds/android/apk	
docker build -t android-package-kit-testbed .
```

### Run the Container

```bash
docker run -it --rm android-package-kit-testbed /bin/bash
```

### Running OSV-Scalibr

Build or copy the `scalibr` binary to the current directory, and inside the container, run `scalibr` with the Android Package Kit extractor:

```bash
./scalibr --extractors=embeddedfs/androidapk --result=output.textproto split_CronetDynamite_installtime.apk
```
