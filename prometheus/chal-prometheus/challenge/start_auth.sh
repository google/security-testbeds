#!/bin/bash

/home/ubuntu/prometheus/prometheus --web.config.file=/home/ubuntu/prometheus/web.yml --config.file=/home/ubuntu/prometheus/prometheus.yml --storage.tsdb.path /home/ubuntu/data  > /home/ubuntu/data/log 2>&1 &  

socat - TCP:127.0.0.1:9090,forever