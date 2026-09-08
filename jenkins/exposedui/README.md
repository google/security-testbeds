# Jenkins Exposed UI

This testbed creates two Jenkins 2.562 instances, one with the setup wizard disabled and anyone allowed to do anything (http://localhost:8081/), and one with default config (http://localhost:8082/).

The default config, with the setup screen, requires a password which is output to the terminal on first boot, and allows configuring authentication during setup (or makes a default admin user with the same password).

## Confirming the vulnerability

```
docker compose up
```

### Vulnerable
```
curl http://localhost:8081/
```

```
...
<title>Dashboard - Jenkins</title>
...
```

### Safe
```
curl http://localhost:8082/
```

Response:
```
...
Authentication required
<!--
You are authenticated as: anonymous
Groups that you are in:
  anonymous
Permission you need to have (but didn't): hudson.model.Hudson.Administer
-->
...
```
