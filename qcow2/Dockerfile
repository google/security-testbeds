FROM ubuntu:22.04

RUN apt-get update

RUN mkdir -p /testdata

# Set working directory
WORKDIR /testdata

# Copy valid .qcow2 files into the container
COPY valid-ext-exfat-fat32-ntfs.qcow2 /testdata/valid-ext-exfat-fat32-ntfs.qcow2
COPY valid-ext-exfat-fat32-ntfs-encrypted.qcow2 /testdata/valid-ext-exfat-fat32-ntfs-encrypted.qcow2

CMD ["/bin/bash"]
