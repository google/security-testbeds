# Use Ubuntu 22.04 base
FROM ubuntu:22.04

# Install bash explicitly (Ubuntu images usually have it, but to be safe)
RUN apt-get update && apt-get install -y bash

# Create the Firefox extension folder
RUN mkdir -p ~/snap/firefox/common/.mozilla/firefox/gw5l1ir8.default/

# Create the Microsoft Edge extension folder
RUN mkdir -p ~/.config/microsoft-edge/Default/

# App for putting scalibr binary inside the container
RUN mkdir -p /app

# Copy local Firefox extension files into the container
COPY extensionFiles/firefox/ /root/snap/firefox/common/.mozilla/firefox/gw5l1ir8.default/extensions/

# Copy local Firefox extension files into the container
COPY extensionFiles/edge/ /root/.config/microsoft-edge/Default/Extensions/

# Set working directory (optional)
WORKDIR /app

# Default command: start bash so the container stays alive interactively
CMD ["/bin/bash"]

