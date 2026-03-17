# Use Ubuntu 22.04 base
FROM ubuntu:22.04

# Install required packets and Lua explicitly (Ubuntu images usually have it, but to be safe)
RUN apt-get update && apt-get install -y bash lua5.4 build-essential libreadline-dev unzip curl liblua5.4-dev

# Luarocks installation directory
RUN mkdir /installation

# App for putting scalibr binary inside the container
RUN mkdir /app

# Download Luarocks latest release
RUN curl -o /installation/luarocks.tar.gz https://luarocks.github.io/luarocks/releases/luarocks-3.12.2.tar.gz -sSf 

# Extract the files
RUN tar -xvzf /installation/luarocks.tar.gz -C /installation/

# Change Workdir for the installation
WORKDIR /installation/luarocks-3.12.2

# Install luarocks
RUN ./configure && make && make install

# Install some rocks
RUN luarocks install luasocket
RUN luarocks install lua-cjson
RUN luarocks install luafilesystem
RUN luarocks install lua-resty-http
RUN luarocks install lua-resty-jwt
RUN luarocks install aesfileencrypt
RUN luarocks install gversion
RUN luarocks install --server=https://luarocks.org/dev gversion dev-0
RUN luarocks install std.normalize

# Change Workdir
WORKDIR /app

# Default command: start bash so the container stays alive interactively
CMD ["/bin/bash"]
