# Use Ubuntu 22.04 base
FROM ubuntu:22.04

# Install bash explicitly (Ubuntu images usually have it, but to be safe)
RUN apt-get update && apt-get install -y bash curl gcc xz-utils git

# Nim installation script directory
RUN mkdir /installation

# App for putting scalibr binary inside the container
RUN mkdir /app

# Install nim language and nimble package manager together
RUN curl -o /installation/init.sh https://nim-lang.org/choosenim/init.sh -sSf 

# Trigger installation
RUN chmod +x /installation/init.sh && /installation/init.sh -y

# For direct nim command usage from the terminal
ENV PATH="/root/.nimble/bin:${PATH}"

# Install some packages for testing including their dependencies with the updated version for the pkgs2 folder
RUN nimble install constantine libp2p uuids c2nim dimscord

# Downgrade nimble so that we can also test for the old version of nimble package location which is pkgs folder
RUN nimble install nimble@0.12.0

# Install some packages for testing including their dependencies with the old version for the pkgs folder
RUN nimble install arrayutils vecmath yaml gura

# Default command: start bash so the container stays alive interactively
CMD ["/bin/bash"]
