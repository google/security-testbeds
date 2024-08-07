#!/bin/bash

ray start --head --dashboard-host=127.0.0.1 --temp-dir /home/user/ray > /logs/log 2>&1 &

# Proxy stdin/stdout to web server
socat - TCP:127.0.0.1:8265,forever