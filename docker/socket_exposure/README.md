# Docker Socket Exposure Testbed

This testbed demonstrates Docker socket exposure vulnerabilities that can be detected by the OSV-Scalibr Docker socket detector.

## Setup

Run `docker compose up` to start both safe and unsafe Docker socket configurations.

## Vulnerable Instance (docker_socket_unsafe)

The unsafe container contains multiple Docker security misconfigurations:

1. **World-writable Docker socket**: `/var/run/docker.sock` has 666 permissions (world-readable and writable)
2. **Non-root socket ownership**: Socket owned by UID 1000 instead of root
3. **Insecure daemon configuration**: `/etc/docker/daemon.json` exposes TCP endpoints without TLS:
   - `tcp://0.0.0.0:2375` (unencrypted, accessible from any IP)
   - `tcp://127.0.0.1:2376` (unencrypted, localhost only)
4. **Insecure systemd service**: Docker service configured with `-H tcp://` flags without `--tls`

### Testing the Vulnerable Container

```bash
# Access the unsafe container
docker exec -it docker_socket_unsafe /bin/bash

# Check socket permissions (should show 666 permissions)
ls -la /var/run/docker.sock

# Check daemon configuration (should show insecure TCP bindings)
cat /etc/docker/daemon.json

# Check systemd service (should show TCP without TLS)
cat /etc/systemd/system/docker.service
```

## Safe Instance (docker_socket_safe)

The safe container demonstrates proper Docker security configurations:

1. **Secure socket permissions**: `/var/run/docker.sock` has 660 permissions (group-readable/writable only)
2. **Proper ownership**: Socket owned by root:docker
3. **Secure daemon configuration**: `/etc/docker/daemon.json` uses TLS authentication for remote access
4. **Secure systemd service**: Docker service configured with proper TLS flags

### Testing the Safe Container

```bash
# Access the safe container
docker exec -it docker_socket_safe /bin/bash

# Check socket permissions (should show 660 permissions)
ls -la /var/run/docker.sock

# Check daemon configuration (should show TLS configuration)
cat /etc/docker/daemon.json

# Check systemd service (should show TLS flags)
cat /etc/systemd/system/docker.service
```

## Running the Detector

To test the OSV-Scalibr Docker socket detector against these containers:

```bash
# Test against unsafe container (should detect vulnerabilities)
docker exec docker_socket_unsafe /path/to/scalibr --detectors=dockersocket /

# Test against safe container (should report no issues)  
docker exec docker_socket_safe /path/to/scalibr --detectors=dockersocket /
```

## Expected Vulnerabilities Detected

The detector should identify the following issues in the unsafe container:

- Docker socket is world-readable (permissions: 666)
- Docker socket is world-writable (permissions: 666)  
- Docker socket owner is not root (uid: 1000)
- Insecure TCP binding in daemon.json: "tcp://0.0.0.0:2375" (consider using TLS)
- Insecure TCP binding in daemon.json: "tcp://127.0.0.1:2376" (consider using TLS)
- Insecure TCP binding in systemd service files (missing TLS)

## Cleanup

```bash
docker compose down
docker image prune -f
```

## Reference

- [Docker Security Documentation](https://docs.docker.com/engine/security/)
- [Docker Daemon Configuration](https://docs.docker.com/engine/reference/commandline/dockerd/)
- [CIS Docker Benchmark](https://www.cisecurity.org/benchmark/docker)