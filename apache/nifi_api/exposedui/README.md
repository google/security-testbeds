# Vulnerable Apache NiFi API with Exposed UI

This directory contains the deployment configs for a vulnerable Apache NiFi API
version (1.12.0).

The deployed service has name `apache-nifi-api` and listens on port `8080`.

## Docker Compose
```
docker compose up
```
Vulnerable service (no authentication) will be on port 8081
Safe service (default auth + TLS) will be on port 8082.

## Testing the vulnerability
### Vulnerable
```
curl localhost:8081/nifi-api/access/config
```
Response:
```
{"config":{"supportsLogin":false}}
```

### Safe
```
curl -vk https://localhost:8082/nifi-api/access/config
```
Response:
```
HTTP/2 401
...

Unauthorized
```

