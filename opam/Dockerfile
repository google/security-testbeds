FROM ubuntu:22.04

# Install opam and build tools for the OCaml switch.
RUN apt-get update && apt-get install -y \
  bash \
  build-essential \
  ca-certificates \
  curl \
  git \
  m4 \
  opam \
  && rm -rf /var/lib/apt/lists/*

RUN useradd -m -s /bin/bash test

# App for putting scalibr binary inside the container.
RUN mkdir -p /app

# Copy opam install script into the container.
COPY testdata/ /testdata/
RUN chmod +x /testdata/install-opam.sh

USER test
ENV HOME=/home/test
RUN /testdata/install-opam.sh

# Set working directory.
WORKDIR /app

# Default command: start bash so the container stays alive interactively.
CMD ["/bin/bash"]
