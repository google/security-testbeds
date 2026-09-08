#!/bin/bash

# Loads password into jupyter's pass file
mkdir -p /home/user/.jupyter

if [ ! -f /home/user/.jupyter/jupyter_server_config.json ]; then
echo '{
  "IdentityProvider": {
    "hashed_password": "CODE"
  }
} ' | sed "s@CODE@$PASS@g" > /home/user/.jupyter/jupyter_server_config.json


touch /home/user/$AUTHFLAG

echo $ROOTFLAG > /flag/flag.txt


unset ROOTFLAG
unset AUTHFLAG
unset PASS
fi

# Start web server
/usr/local/bin/jupyter-notebook --ServerApp.allow_remote_access=1 > /logs/$(date +%s).log 2>&1 &
# Proxy stdin/stdout to server
socat - TCP:127.0.0.1:8888,forever
 #/bin/bash -i