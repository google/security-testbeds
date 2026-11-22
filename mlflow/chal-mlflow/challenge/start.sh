#!/bin/sh

cp /basic_auth.db /home/user

sqlite3 /home/user/basic_auth.db "UPDATE users SET password_hash = '$PASSWORD' WHERE id = 1;"

(/usr/local/bin/mlflow server --host 0.0.0.0 --dev --app-name basic-auth --workers=1) >> /logs/$(date +%s).log  2>&1 &
socat - TCP:127.0.0.1:5000,forever 