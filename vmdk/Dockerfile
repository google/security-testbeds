FROM ubuntu:22.04

RUN apt-get update

RUN mkdir -p /testdata

# Set working directory
WORKDIR /testdata

# Copy valid .vmdk file into the container
COPY valid-fat32-ext.vmdk /testdata/valid-fat32-ext.vmdk

CMD ["/bin/bash"]