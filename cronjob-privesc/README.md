# Cron Job Privilege Escalation Testbed

This directory contains the deployment configs for a Linux environment with misconfigured cron jobs that can lead to privilege escalation. It includes:
*   Root cron jobs executing scripts in world-writable directories (`/opt/insecure_dir`).
*   Relative paths in privileged cron jobs (`/etc/cron.d/misconfig`).
*   World-writable scripts executed by root (`/usr/local/bin/weak_script.sh`).

## Running the Testbed

To start the vulnerable container:

```bash
docker-compose up -d --build
```

## Steps to Reproduce / Verify

### 1. Verify Vulnerable Configurations Manually
You can inspect the running container to confirm the misconfigurations exist (e.g., world-writable directories and scripts):

```bash
# Get the container ID
CONTAINER_ID=$(docker-compose ps -q vulnerable-cron)

# Check permissions of the insecure directory (should be drwxrwxrwx)
docker exec $CONTAINER_ID ls -ld /opt/insecure_dir

# Check permissions of the weak script (should be -rwxrwxrwx)
docker exec $CONTAINER_ID ls -l /usr/local/bin/weak_script.sh

# View the relative path misconfiguration
docker exec $CONTAINER_ID cat /etc/cron.d/misconfig
```

### 2. Verify Detection with SCALIBR
Run SCALIBR against the built image to confirm it detects the vulnerabilities:

```bash
# From the root of the osv-scalibr repository:
./run_scalibr_on_image.sh cronjobprivesc:latest
```

The scan results (in `scalibr-result.textproto`) should contain findings matching:
*   `execution from world-writable directory`
*   `relative path`
*   `is world-writable`
