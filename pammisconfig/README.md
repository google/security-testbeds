# PAM Misconfiguration Testbed

This testbed exercises the SCALIBR PAM misconfiguration detector. It provides
intentionally vulnerable PAM configurations under `/etc/pam.d/` and the legacy
`/etc/pam.conf` file to trigger all detection checks.

## Build & Run

```sh
docker build -t pammisconfig-testbed .
docker run -it --rm -v $(pwd):/app pammisconfig-testbed
```

## Vulnerability Coverage

| File | Triggered checks |
| --- | --- |
| `/etc/pam.d/sshd` | pam_permit bypass, pam_succeed_if broad condition, nullok auth option |
| `/etc/pam.d/sudo` | pam_permit as only optional auth module (only auth entry) |
| `/etc/pam.conf` | pam_permit bypass, pam_succeed_if broad condition, nullok auth option |
