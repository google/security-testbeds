FROM ubuntu:22.04

RUN apt-get update

RUN mkdir -p /testdata

# Set working directory
WORKDIR /testdata

# Copy valid .vmdk file into the container
COPY valid.vmdk /testdata/valid.vmdk

CMD ["/bin/bash"]