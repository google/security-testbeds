#!/bin/bash

chmod a=w /home/model-server/logs/log
echo "$ROOTFLAG" > /flag/flag.txt

cp /flag.mar /home/model-server/model-store/"$AUTHFLAG".mar

/home/venv/bin/torchserve --start --ts-config /home/model-server/config.properties --model-store ./model-store --models "$AUTHFLAG".mar > /home/model-server/logs/$(date +%s).log &

socat - TCP:127.0.0.1:8081,forever