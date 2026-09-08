#!/bin/bash
/home/ubuntu/node_exporter/node_exporter > /logs/$(date +%s).log 2>&1 &

socat - TCP:127.0.0.1:9100,forever
