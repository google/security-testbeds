# RPM OS Testbed

This testbed is developed to verify that scalibr adds the exploitability signals (related to `osduplicate`) only to packages which were added through default repositories.

Inventories returned from files which are part of `rpm` packages installed via default repository receive an OS-level advisory which is more precise and less prone to false positives, while packages installed by other means do not receive any OS-level advisory and should be covered using language-level extractors.

The docker-compose contains multiple docker images which install a pkg from a default repository and from one from an extra one. Then the `verify.sh` script is used to ensure that scalibr correctly adds `exploitability_signals` only to the pkg installed via the default repo.

## Verification Steps

Build the image and run the testbed:

```sh
docker compose up --build
```

For manual verification launch:

```sh
docker compose run amazonlinux2 bash
```
