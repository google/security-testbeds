#!/usr/bin/env bash
set -e
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