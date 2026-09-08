#!/bin/bash
java -jar $JETTY_HOME/start.jar > /logs/$(date +%s).log 2>&1 &
# 
socat - TCP:127.0.0.1:8080,forever
