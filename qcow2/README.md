# OSV-Scalibr: QCOW2 Extractor

This directory contains a test Dockerfile for validating OSV-Scalibr's QCOW2 Extractor plugin. A QCOW (Copy on Write) file is a disk image format commonly used by virtual machines to emulate a physical hard drive.

## Setup

### Build the Docker Image

```bash
cd security-testbeds/qcow2
docker build -t qcow2-extractor-testbed .
```

### Run the Container

```bash
docker run -it --rm qcow2-extractor-testbed /bin/bash
```

### Running OSV-Scalibr

Build or copy the `scalibr` binary to the current directory, and inside the container, run `scalibr` with the qcow2 extractor:

```bash
./scalibr --plugin-config=qcow2:{password:\"Yuvraj\"} --plugins=secrets/privatekey --extractors=embeddedfs/qcow2 --result out.textproto valid-ext-exfat-fat32-ntfs.qcow2 valid-ext-exfat-fat32-ntfs-encrypted.qcow2
```
