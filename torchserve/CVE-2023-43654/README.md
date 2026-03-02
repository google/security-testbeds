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
- **torchserve-latest:** The latest version (currently 0.12.0), with default settings, no longer vulnerable

## Setup Instructions

### Starting TorchServe Services
To start all the TorchServe services in detached mode:

```bash
docker compose up -d
```

To start a specific TorchServe service, for example, `torchserve-081`:

```bash
docker compose up -d torchserve-081
```

## Using Tsunami for Testing

After starting the containers using the command above, run the following command to scan the container `torchserve-081` using Tsunami. Change the container name in the `--uri-target` argument to scan the other containers.

```bash
docker compose run --rm --name=tsunami tsunami \
    bash -c "apt-get update && apt-get install -y nmap && \
        tsunami --uri-target=http://torchserve-081:8081 \
        --torchserve-management-api-mode=local \
        --torchserve-management-api-local-bind-host=tsunami \
        --torchserve-management-api-local-bind-port=1234 \
        --torchserve-management-api-local-accessible-url=http://tsunami:1234"
```

## Cleanup

Stop and remove all the containers:
```bash
docker compose down
```