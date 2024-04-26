#!/bin/bash


# Loads password into jupyter's pass file
mkdir /home/user/.jupyter

echo '{
  "IdentityProvider": {
    "hashed_password": "CODE"
  }
}' | sed "s/CODE/$PASS/g" > /home/user/.jupyter/jupyter_server_config.json


touch /home/user/$AUTHFLAG

echo $ROOTFLAG > /flag/flag.txt

unset ROOTFLAG
unset AUTHFLAG
unset PASS

# Start web server
/usr/local/bin/jupyter-notebook > /logs/log 2>&1 &
# Proxy stdin/stdout to server
socat - TCP:127.0.0.1:8888,forever
 #/bin/bash -i