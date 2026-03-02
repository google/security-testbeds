# Linux ld.so.preload Weak Permissions

Testbed for insecure `/etc/ld.so.preload` permissions and ownership that allow
privilege escalation via dynamic linker preload hijacking.

## Setup

```bash
docker build -t ldso-preload-vulnerable -f Dockerfile.vulnerable .
docker build -t ldso-preload-safe -f Dockerfile.safe .
```

## How to Trigger the Vulnerability?

The vulnerable image has a world-writable `/etc/ld.so.preload`, non-root
ownership, and a writable `/etc` directory. Run SCALIBR against each image.

```bash
# From the osv-scalibr repo root
./run_scalibr_on_image.sh ldso-preload-vulnerable
```

The safe image should not produce findings:

```bash
./run_scalibr_on_image.sh ldso-preload-safe
```

## References
- https://attack.mitre.org/techniques/T1574/006/
