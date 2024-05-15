#!/bin/bash

echo "$ROOTFLAG" > /flag/flag.txt

cp /flag.mar /home/model-server/model-store/"$AUTHFLAG".mar

/home/venv/bin/torchserve --start --plugins-path /home/model-server/jars --ts-config /home/model-server/config.properties --models "$AUTHFLAG".mar > /home/model-server/logs/log &

socat - TCP:127.0.0.1:8081,forever