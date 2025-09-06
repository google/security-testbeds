# OSV-Scalibr: Luarocks Extractor

This directory contains the Dockerfile for testing OSV-Scalibr Luarocks Extractor plugin. Luarocks is the package manager for modules written in Lua language. For this image, Luarocks stores the metadata of installed modules under "/usr/local/lib/luarocks/rocks-5.4" path, with each module’s .rockspec file located in its corresponding subdirectory. This plugin enumerates these paths extract module name and version of installed modules.

## Setup

```sh
docker build -t luarocks-test .
docker run -it --rm -v $(pwd):/app luarocks-test (to put scalibr binary inside the container)
```
