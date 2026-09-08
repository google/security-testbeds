FROM ubuntu:22.04

RUN apt-get update

RUN mkdir -p /testdata

# Set working directory
WORKDIR /testdata

# Copy valid-but-nonbootable .ova file into the container
COPY Alpine.ova /testdata/Alpine.ova

CMD ["/bin/bash"]