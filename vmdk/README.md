# OSV-Scalibr: VMDK Extractor

This directory contains a test Dockerfile for validating OSV-Scalibr's VMDK Extractor plugin. A VMDK (Virtual Machine Disk) file is a disk image format commonly used by virtual machines to emulate a physical hard drive.

## Setup

### Build the Docker Image

```bash
cd security-testbeds/vmdk
docker build -t vmdk-extractor-testbed .
```

### Run the Container

```bash
docker run -it --rm vmdk-extractor-testbed /bin/bash
```

### Running OSV-Scalibr

Build or copy the `scalibr` binary to the current directory, and inside the container, run `scalibr` with the vmdk extractor:

```bash
./scalibr --extractors=embeddedfs/vmdk --result=output.textproto valid-ext-exfat-fat32-ntfs.vmdk
```
