# Use Ubuntu 22.04 base
FROM ubuntu:22.04

# Install bash explicitly (Ubuntu images usually have it, but to be safe)
RUN apt-get update && apt-get install -y bash curl gcc wget xz-utils

# App for putting scalibr binary inside the container
RUN mkdir /app

# installation for putting zig files
RUN mkdir /installation

# Set working directory
WORKDIR /installation

# Install zig language
RUN wget http://ziglang.org/builds/zig-x86_64-linux-0.16.0-dev.2565+684032671.tar.xz

# Unzip the zig binary
RUN tar -xvf zig-x86_64-linux-0.16.0-dev.2565+684032671.tar.xz

# Make a symbolic link for the execution
RUN ln -s /installation/zig-x86_64-linux-0.16.0-dev.2565+684032671/zig /usr/local/bin/zig 

# Put an old version of build.zig.zon file for testing purposes
RUN wget https://raw.githubusercontent.com/Jesperoka/battlebuds/6f1797440cad60163bf5ea19153c18c63b22f802/build.zig.zon

# Start a Zig Project
RUN mkdir hello_world 

WORKDIR /installation/hello_world

RUN zig init

# Add some dependencies and library sources with different protocols and ways
RUN zig fetch --save git+https://github.com/Aandreba/zigrc/

RUN zig fetch --save git+https://github.com/BarabasGitHub/LZig4/#HEAD

RUN zig fetch --save git+https://github.com/allyourcodebase/libmp3lame.git

RUN zig fetch --save https://github.com/karlseguin/zul/archive/master.tar.gz

RUN zig fetch --save https://github.com/r4gus/zbor/archive/refs/tags/0.18.0.tar.gz

RUN zig fetch --save git+https://codeberg.org/ifreund/zig-wayland#b2df7eda58badac138faea6fd78c7f08c8ef936a

RUN zig fetch --save git+https://github.com/griush/zm#8ae7b0cda11585364a7f457e20bca42df5e4405c

RUN zig fetch --save git+https://github.com/jcalabro/zls.git

# Build the project to populate zig recursive dependencies and start the bash because zig build requires TTY
CMD ["/bin/bash", "-c", "zig build && cd /app && /bin/bash"]
