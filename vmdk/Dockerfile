FROM ubuntu:22.04

RUN apt-get update

RUN mkdir -p /testdata

# Set working directory
WORKDIR /testdata

# Copy valid .vmdk file into the container
COPY valid-ext-exfat-fat32-ntfs.vmdk /testdata/valid-ext-exfat-fat32-ntfs.vmdk

CMD ["/bin/bash"]
