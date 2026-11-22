# LiteLLM Unauthenticated REST API and Model Exposure

A critical misconfiguration / exposure vulnerability exists in LiteLLM Proxy instances deployed without master key authentication. When `LITELLM_MASTER_KEY` is omitted, the proxy server allows unauthenticated access to `/health/readiness`, `/v1/models`, `/models`, and `/model/info`.

Remote unauthenticated attackers can enumerate all configured backend LLM models, internal routing parameters, and deployment metadata. If inference endpoints (`/v1/chat/completions`, `/v1/embeddings`, etc.) are also reachable without authentication, unauthorized parties can send arbitrary inference requests and drain upstream LLM provider API credits ("denial of wallet").

## Vulnerable Environment

The deployed environment starts an unauthenticated LiteLLM proxy instance on port `4000`.

### Setup
```sh
docker compose up -d litellm-vulnerable
```

### Fingerprint Check
Verify that the service is a running LiteLLM instance:
```sh
curl -i http://localhost:4000/health/readiness
```

Response (`200 OK`):
```json
HTTP/1.1 200 OK
Content-Type: application/json

{
  "status": "connected",
  "db": "connected",
  "litellm_version": "1.40.0"
}
```

### Testing the Exposure
Query the `/v1/models` endpoint without providing an `Authorization` header:
```sh
curl -i http://localhost:4000/v1/models
```

Response (`200 OK`):
```json
HTTP/1.1 200 OK
Content-Type: application/json

{
  "object": "list",
  "data": [
    {
      "id": "gpt-4o",
      "object": "model",
      "created": 1677610602,
      "owned_by": "openai"
    },
    {
      "id": "claude-3-5-sonnet",
      "object": "model",
      "created": 1677610602,
      "owned_by": "anthropic"
    },
    {
      "id": "text-embedding-3-small",
      "object": "model",
      "created": 1677610602,
      "owned_by": "openai"
    }
  ]
}
```

## Safe / Secured Environment

The secured instance runs on port `4001` with `LITELLM_MASTER_KEY` configured, enforcing API key authentication on all routes.

### Setup
```sh
docker compose up -d litellm-secured
```

### Testing Unauthenticated Access (Blocked)
```sh
curl -i http://localhost:4001/v1/models
```

Response (`401 Unauthorized`):
```json
HTTP/1.1 401 Unauthorized
Content-Type: application/json

{
  "error": {
    "message": "Authentication Error, Provide a valid API Key",
    "type": "auth_error",
    "param": null,
    "code": "401"
  }
}
```

### Testing Authorized Access (Allowed)
```sh
curl -i -H "Authorization: Bearer sk-test-master-key-12345" http://localhost:4001/v1/models
```

Response (`200 OK`):
```json
HTTP/1.1 200 OK
Content-Type: application/json

{
  "object": "list",
  "data": [
    {
      "id": "gpt-4o",
      "object": "model",
      "created": 1677610602,
      "owned_by": "openai"
    }
  ]
}
```

## Teardown
```sh
docker compose down
```

