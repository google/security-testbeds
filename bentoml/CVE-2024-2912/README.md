# vulnerble version setup

```bash
docker compose -f docker-compose-vulnerable.yml up
```
run the exploit:
```
ncat -klnv 1337
python3 exploit.py
```
you'll receive a http request on port 1337 which means the exploit worked.

# safe version setup

```bash
docker compose -f docker-compose-safe.yml up
```
run the exploit:
```
ncat -klnv 1337
python3 exploit.py
```
you won't receive any data on port 1337 since the exploit didn't work.
