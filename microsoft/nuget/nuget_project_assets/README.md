# OSV-Scalibr: NuGet Project Assets Extractor

This directory contains a test Dockerfile for validating OSV-Scalibr's NuGet Project Assets Extractor plugin.

## Setup

### Build the Docker Image

```bash
cd security-testbeds/microsoft/nuget/nuget_project_assets	
docker build -t nuget-project-assets-testbed .
```

### Run the Container

```bash
docker run -it --rm nuget-project-assets-testbed /bin/bash
```

### Running OSV-Scalibr

Build or copy the `scalibr` binary to the current directory, and inside the container, run `scalibr` with the vmdk extractor:

```bash
./scalibr --extractors=dotnet/projectassetsjson --result=output.textproto project.assets.json
```
