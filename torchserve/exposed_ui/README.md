# TorchServe Vulnerability Testbed
## Overview
This testbed provides a Docker Compose setup to test the TorchServe Management API Detection Plugin against various versions of TorchServe, demonstrating different vulnerability scenarios. It includes four TorchServe containers with varying configurations to simulate different security postures.

## Prerequisites
Before starting, ensure Docker and Docker Compose are installed on your system.

## TorchServe Containers
The testbed includes the following TorchServe containers:

- **torchserve-081:** Version 0.8.1, vulnerable to the ShellTorch attack.
- **torchserve-082:** Version 0.8.2, patched for ShellTorch but still vulnerable due to default `allowed_urls`.
- **torchserve-safe:** Version 0.8.2 with `allowed_urls` correctly restricted, representing a secure setup.
- **torchserve-latest:** The latest version (currently 0.9.0), with default settings and vulnerabilities similar to torchserve-082.

## Setup Instructions

### Building Tsunami Docker Image
Clone the Tsunami repository and build the Docker image:

```bash
git clone git@github.com:google/tsunami-security-scanner.git
cd tsunami-security-scanner
docker build -t tsunami .
```

### Custom Tsunami Plugins
1. Adding custom plugins
    - Compile your custom plugins into JAR files.
    - Place your custom plugin JAR files into the `tsunami/custom_plugins/` directory.
2. Rebuilding the Docker image
    - Each time add or update plugins, you need to rebuild the Docker image.
    - Run the following command to rebuild the Docker image:
        ```bash
        docker compose build tsunami
        ```
    - `docker compose up --build` will also work
3. Configure which plugins to run
    - `USE_CUSTOM_PLUGINS`: set this environment variable to `true` to enable custom plugins.
    - `USE_DEFAULT_PLUGINS`: set this environment variable to `false` to disable default plugins.
    - both can be enabled at the same time, or just one of them.

### Starting TorchServe Services
To start all the TorchServe services in detached mode:

```bash
docker compose up -d
```

To start a specific TorchServe service, for example, `torchserve-081`:

```bash
docker compose up -d torchserve-081
```

### Stopping Services
To stop all services without removing containers:

```bash
docker compose stop
```

To stop and remove containers:

```bash
docker compose down
```

To stop, remove containers, and volumes:

```bash
docker compose down -v
```

### Accessing Logs
To follow the log output of the containers:

```bash
docker compose logs -f
```

## Using Tsunami for Testing
Getting a Shell in Tsunami Container

```bash
docker compose run --rm --entrypoint /bin/bash tsunami
```

Running Tsunami Commands:

```bash
# Regular scan
docker compose run --rm tsunami --uri-target=http://torchserver-081:8081
# Custom options to force Static mode
docker compose run --rm tsunami --uri-target=http://torchserve-safe:8081 \
    --torchserve-management-api-mode=static \
    --torchserve-management-api-model-static-url=http://e4d14c157244:8000/model.mar
```

Note that the `--name=tsunami` option is required for Local mode scan to work, as otherwise the container name will be randomly generated and not match the hostname in the scan results:

```bash
docker compose run --rm --name=tsunami tsunami --uri-target=http://torchserve-081:8081 \
    --torchserve-management-api-mode=local --torchserve-management-api-local-bind-host=tsunami \
    --torchserve-management-api-local-bind-port=1234 \
    --torchserve-management-api-local-accessible-url=http://tsunami:1234
```

To only output JSON and nicely format the output with `jq`:

```bash
docker compose run --rm tsunami --uri-target=http://torchserver-081:8081 --json | jq
```
For a concise output:

```bash
docker compose run --rm tsunami --uri-target=http://torchserver-081:8081 --short
```
