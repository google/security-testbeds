#!/bin/bash

npm start --cache /data/.npm --userDir /data > /logs/$(date +%s).log 2>&1 &
socat - TCP:127.0.0.1:1880,forever
