# JDBC URL Testbed

This testbed spins up PostgreSQL, MySQL, and SQL Server containers for testing JDBC URL credential extraction
with [SCALIBR](https://github.com/google/osv-scalibr).

## Prerequisites

- Docker & Docker Compose
- SCALIBR binary (`./scalibr`)

## 1. Configure `/etc/hosts`

Add the following entry so that `publichost` resolves to your loopback address:

```bash
echo '127.0.0.1 publichost' | sudo tee -a /etc/hosts
```

Verify it works:

```bash
ping -c 1 publichost
```

## 2. Start the Database Containers

```bash
docker compose up -d
```

This starts:

| Service           | Image                                 | Port | Auth                          |
|-------------------|---------------------------------------|------|-------------------------------|
| `postgres-auth`   | `postgres:16`                         | 5432 | password (`mysecretpassword`) |
| `postgres-noauth` | `postgres:16`                         | 5433 | trust (no password)           |
| `mysql-auth`      | `mysql:8.0`                           | 3306 | password (`password`)         |
| `mysql-noauth`    | `mysql:8.0`                           | 3307 | empty root password           |
| `sqlserver-auth`  | `mcr.microsoft.com/mssql/server:2022` | 1433 | password (`YourStr0ngP@ss`)   |

Wait a few seconds for all databases to finish initializing before running the scan.

## 3. Run SCALIBR

Execute the SCALIBR extractor against the JDBC URL config file:

```bash
./scalibr \
  --extractors=secrets/jdbcurlcreds \
  --result=output.textproto \
  JDBCURLS-config.json
```

The results will be written to `output.textproto`.

## 4. Tear Down

Stop and remove all containers:

```bash
docker compose down
```