# Omnilab Android Test Studio

Setup for Omnilab ATS exposed UI testbed.

## Deployment

The testbed can be deployed using docker compose running the following inside this directory

```sh
docker compose up -d
```

This will setup an exposed instance (without any authentication) at <http://localhost:8000> and an instance behind basic auth (Omnilab ATS does not provide any authentication) at <http://localhost:8001> (creds are `admin`:`changeme`).

The testbed can then be stopped and removed running the following from within the same directory

```sh
docker compose down
```

## Resources

- <https://source.android.com/docs/core/tests/development/android-test-station/ats-user-guide>
- <https://android.googlesource.com/platform/tools/multitest_transport/+/refs/heads/multitest-transport-dev>
