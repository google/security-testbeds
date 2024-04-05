# setup 
## vulnerable instance
1. run the mlflow instance
```bash
docker run -p 127.0.0.1:5000:5000 ghcr.io/mlflow/mlflow:v2.11.3 mlflow server --app-name basic-auth --host 0.0.0.0 --port 5000
```
2. open http://127.0.0.1:5000.
3. enter admin/password as username and password.

## safe instance
1. run the mlflow instance
```bash
docker run -p 127.0.0.1:5000:5000 ghcr.io/mlflow/mlflow:v2.11.3 mlflow server --app-name basic-auth --host 0.0.0.0 --port 5000
```
2. run `curl http://127.0.0.1:5000/api/2.0/mlflow/users/update-password --user admin:password -H "Content-Type: application/json" -d '{"username": "admin", "password": "randomPass"}' -X PATCH`
2. open http://127.0.0.1:5000.
3. enter admin/randomPass as username and password which is not the default credentials.
