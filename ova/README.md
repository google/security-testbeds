# OSV-Scalibr: OVA Extractor

This directory contains the test Dockerfile for testing OSV-Scalibr's ova Extractor plugin. Open Virtualization Appliance (OVA) package is a tar archive file with the OVF directory inside. Open Virtualization Format (OVF) is an open standard for packaging and distributing virtual appliances.

## Setup

### Build the Docker Image

```bash
cd security-testbeds/ova
docker build -t ova-extractor-testbed .
```

### Run the Container

```bash
docker run -it --rm ova-extractor-testbed /bin/bash
```

### Running OSV-Scalibr

Build or copy the `scalibr` binary to the current directory, and inside the container, run `scalibr` with the ova extractor:

```bash
./scalibr --extractors=embeddedfs/ova --result=output.textproto .
```