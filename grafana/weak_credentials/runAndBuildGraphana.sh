#!/bin/bash
set -e
docker build --platform linux --no-cache -t graphana:test -f Dockerfile.Grafana . && docker run -p 127.0.0.1:8873:3000 -it --rm graphana:test