# vulnerable setup
```bash
docker compose up -d
python3 proxy.py
# in another shell
curl -k -vvvv 'http://127.0.0.1:8080/openapi/v3'
```
for testing the safe setup just send the request directly to the REST API server:
```
curl -k -vvvv 'http://10.11.1.6:6820/openapi/v3'
# TTP/1.1 401 UNAUTHORIZED
```
