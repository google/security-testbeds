# APK OS Testbed

This testbed is developed to verify that scalibr adds the exploitability signals (related to `osduplicate`) only to packages which were added through default repositories.

Inventories returned from files which are part of `apk` packages installed via default repository receive an OS-level advisory which is more precise and less prone to false positives, while packages installed by other means do not receive any OS-level advisory and should be covered using language-level extractors.

In this example the `Dockerfile` installs:

- `fzf` from a default repository
- `orb` from a custom repository

## Verification Steps

Build the image and run the testbed:

```sh
docker build --platform linux/amd64 -t osduplicate-apk -f Dockerfile ..
docker run --rm --platform linux/amd64 -v /tmp/scalibr:/usr/bin/scalibr osduplicate-apk /usr/bin/verify.sh
```

For manual verification launch:

```sh
docker build --platform linux/amd64 -t osduplicate-apk . -f Dockerfile ..
docker run --rm -it --platform linux/amd64 -v /tmp/scalibr:/usr/bin/scalibr osduplicate-apk
```
