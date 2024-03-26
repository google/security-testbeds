# setup 
1. run the mlflow instance
```bash
docker run -p 127.0.0.1:5000:5000 ghcr.io/mlflow/mlflow:v2.11.3 mlflow server --app-name basic-auth --host 0.0.0.0 --port 5000
```
2. open http://127.0.0.1:5000.
3. enter admin/password as username and password.
