#!/bin/bash

# Start node web server
(&>/dev/null /usr/local/bin/jupyter-notebook)&

# Proxy stdin/stdout to web server
socat - TCP:127.0.0.1:8888,forever
