#!/bin/bash
/home/ubuntu/node_exporter/node_exporter > /logs/$(date +%s).log 2>&1 &
/home/ubuntu/prometheus/prometheus --config.file=/home/ubuntu/prometheus/prometheus.yml --storage.tsdb.path /home/ubuntu/data > /logs/$(date +%s).log 2>&1 &  

socat - TCP:127.0.0.1:9090,forever

