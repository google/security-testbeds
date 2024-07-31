# vulnerble version setup

```
apt install python3.10 python3.10-venv python3-pip 
python3 -m venv . && source bin/activate
pip install torch transformers bentoml==1.2.0
bentoml serve service:Summarization
```
run the exploit:
```
ncat -klnv 1337
python3 exploit.py
```
you'll receive a http request on port 1337 which means the exploit worked.

# safe version setup

```
apt install python3.10 python3.10-venv python3-pip 
python3 -m venv . && source bin/activate
pip install torch transformers bentoml==1.2.5
bentoml serve service:Summarization
```

run the exploit:
```
ncat -klnv 1337
python3 exploit.py
```
you won't receive any data on port 1337 since the exploit didn't work.
