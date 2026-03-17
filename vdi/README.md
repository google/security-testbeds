# OSV-Scalibr: VDI Extractor

This directory contains a test Dockerfile for validating OSV-Scalibr's VDI Extractor plugin. A VDI file is a disk image format commonly used by virtual machines to emulate a physical hard drive.

## Setup

### Build the Docker Image

```bash
cd security-testbeds/vdi
docker build -t vdi-extractor-testbed .
```

### Run the Container

```bash
docker run -it --rm vdi-extractor-testbed /bin/bash
```

### Running OSV-Scalibr

Build or copy the `scalibr` binary to the current directory, and inside the container, run `scalibr` with the vdi extractor:

```bash
./scalibr --extractors=embeddedfs/vdi --result=output.textproto valid-ext-exfat-fat32-ntfs-static.vdi
./scalibr --extractors=embeddedfs/vdi --result=output.textproto valid-ext-exfat-fat32-ntfs-dynamic.vdi
```
