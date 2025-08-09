# Setup Vulnerable and Secure Instances

# Prerequisites

1. Ubuntu 24.04 machine with 8GB RAM and 16 CPUs and 40GB disk space.
2. A `docker.com` account.

# Vulnerable and Secure Instances

```bash
bash start.sh
```

Access the secure instance with login and authentication enabled at http://localhost:8080. Access the exposed UI,
which has authentication disabled and is vulnerable to attacks, at http://localhost:8081. You can create and run a
new pipeline here.

# cleanup

```bash
bash cleanup.sh
```