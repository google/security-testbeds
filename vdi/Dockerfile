FROM ubuntu:22.04

RUN apt-get update

RUN mkdir -p /testdata

# Set working directory
WORKDIR /testdata

# Copy valid .vdi file into the container
COPY valid-ext-exfat-fat32-ntfs-static.vdi /testdata/valid-ext-exfat-fat32-ntfs-static.vdi
COPY valid-ext-exfat-fat32-ntfs-dynamic.vdi /testdata/valid-ext-exfat-fat32-ntfs-dynamic.vdi

CMD ["/bin/bash"]
