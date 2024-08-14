# vulnerable instance
```bash
docker compose -f docker-compose-vulnerable.yaml up
```
Go to http://127.0.0.1:8080/login and enter airflow/airflow as username and password.

# secure instance
```bash
docker compose -f docker-compose-secure.yaml up
```
this time the username and password are random so this is a secure airflow intance.
