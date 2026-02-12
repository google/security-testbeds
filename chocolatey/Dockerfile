# Use Ubuntu 22.04 base
FROM ubuntu:22.04

# Install bash explicitly (Ubuntu images usually have it, but to be safe)
RUN apt-get update && apt-get install -y bash

# Create the chocolatey folder
RUN mkdir -p /test/chocolatey/

# App for putting scalibr binary inside the container
RUN mkdir -p /app

# Copy local chocolatey directories into the container
COPY chocolatey/ /test/chocolatey/

# Set working directory (optional)
WORKDIR /app

# Default command: start bash so the container stays alive interactively
CMD ["/bin/bash"]

