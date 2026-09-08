#!/bin/bash

python3 script.py > /logs/$(date +%s).log 2>&1 &
flask --app app run > /logs/$(date +%s).log 2>&1 &

# Proxy stdin/stdout to server
socat - TCP:127.0.0.1:5000,forever