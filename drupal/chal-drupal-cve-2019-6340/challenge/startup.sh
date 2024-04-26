#!/bin/bash
cp -r /copy/sites .

apache2-foreground > /dev/null 2>&1 &

# Proxy stdin/stdout to server
socat - TCP:127.0.0.1:8080,forever,fork