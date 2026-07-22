Here's the corrected and tightened version:

---

# n8n Exposed REST API

n8n is a workflow automation platform for creating and executing automated workflows. This testbed demonstrates both exposed and properly secured configurations of the n8n REST API.

## Vulnerable Setups

```shell
docker compose -f docker-compose-vuln.yml up -d
```
Early n8n versions (e.g. 0.54.0) shipped without user management. This setup reproduces that behavior: the REST API is fully accessible without authentication and the `/rest/login` endpoint does not exist.

```shell
docker compose -f docker-compose-vuln-no-owner.yml up -d
```
Later 0.x versions introduced user management but allowed instances to run without a configured owner account. In this state, the REST API is accessible without authentication. The `/rest/login` endpoint exists and returns a session cookie on anonymous requests, which can be used in subsequent calls as demonstrated in the steps below.

```shell
docker compose -f docker-compose-vuln-auth.yml up -d
```
Reproduces the BasicAuth split-brain misconfiguration: BasicAuth is enabled and protects the UI (returns `401`), but the `/rest/*` router has no auth middleware applied and remains fully accessible without credentials.

## Safe Setup

```shell
docker compose -f docker-compose-non-vuln.yml up -d
```
A properly configured n8n instance with authentication enforced on all `/rest/*` endpoints. The detector must produce no finding against this target.

## Steps to Reproduce

### Step 1 — Fingerprint

Confirm the target is n8n 0.x by checking for fields that are only present in the 0.x settings schema:

```shell
curl -s http://<target>:5678/rest/settings | jq .
```

Expected response on a vulnerable instance:

```json
{
  "data": {
    ...
    "urlBaseWebhook": "http://<target>:5678/",
    "versionCli": "0.237.0",
    "saveManualExecutions": false,
    "saveDataErrorExecution": "all",
    ...
  }
}
```

The presence of `versionCli` and `urlBaseWebhook` confirms this is n8n 0.x. This fingerprint self-scoping — the detector cannot fire against modern instances regardless of their configuration.

### Step 2 — Session Bootstrap (where applicable)

On instances with user management enabled but no owner configured (`docker-compose-vuln-no-owner.yml`), an anonymous `GET /rest/login` returns a valid session cookie:

```shell
curl -s -i http://<target>:5678/rest/login
```

Expected response:

```
HTTP/1.1 200 OK
Set-Cookie: n8n-auth=<jwt>; Path=/; HttpOnly; SameSite=Lax
```

On early versions without user management (`docker-compose-vuln.yml` and `docker-compose-vuln-auth.yml`), this endpoint does not exist. The cookie is not needed — `/rest/workflows` is directly accessible without one.

### Step 3 — Workflows Access

Without cookie (early versions / split-brain):

```shell
curl -s http://<target>:5678/rest/workflows | jq .
```

With cookie (no-owner setup):

```shell
curl -s -H 'Cookie: n8n-auth=<jwt>' http://<target>:5678/rest/workflows | jq .
```

Expected response in both cases:

```json
{
  "data": [
    {
      ...
    }
  ]
}
```

Confirms unauthenticated (or pre-authentication anonymous session) access to workflow data.

## Notes

- The vulnerable surface spans all n8n 0.x releases. Early versions (e.g. 0.54.0) had no user management and optional auth that did not cover `/rest/*` routes. Later 0.x versions introduced user management but remained exploitable when no owner account was initialized, or when flags such as `N8N_USER_MANAGEMENT_DISABLED` produced inconsistent auth behavior.
- n8n 1.x enforces authentication at the application layer via session middleware applied directly to the `/rest/` router. Empirical testing confirms that `/rest/workflows` returns `401` on all 1.x+ configurations, including fresh instances with no owner account configured. Reverse proxy misconfigurations that forward unauthenticated requests still reach n8n's own auth check and do not bypass it.
- The `versionCli` and `urlBaseWebhook` fields in `/rest/settings` are unique to n8n 0.x. Their absence in 1.x+ means the fingerprint step will not match modern instances, preventing false positives by design.

## References

- https://github.com/n8n-io/n8n
- https://docs.n8n.io/hosting/securing/overview/
