#!/bin/bash

ray start --head --dashboard-host=127.0.0.1 > /dev/null 2>&1 &

# Proxy stdin/stdout to web server
socat - TCP:127.0.0.1:8265,forever