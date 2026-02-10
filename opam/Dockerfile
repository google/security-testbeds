FROM ubuntu:22.04

# Install bash explicitly (Ubuntu images usually have it, but to be safe)
RUN apt-get update && apt-get install -y bash && rm -rf /var/lib/apt/lists/*

# Create opam default switch install path
RUN mkdir -p /home/test/.opam/default/.opam-switch

# App for putting scalibr binary inside the container
RUN mkdir -p /app

# Copy opam test data into the container
COPY testdata/ /

# Set working directory
WORKDIR /app

# Default command: start bash so the container stays alive interactively
CMD ["/bin/bash"]
