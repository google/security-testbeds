FROM ubuntu:22.04

RUN apt-get update

RUN mkdir -p /testdata

# Set working directory
WORKDIR /testdata

# Copy valid .vdi file into the container
COPY valid.vdi /testdata/valid.vdi

CMD ["/bin/bash"]