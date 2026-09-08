#!/bin/bash

echo $ROOTFLAG > /flag/flag.txt  

java -jar /h2o/h2o.jar > /logs/$(date +%s).log 2>&1 &

# Proxy stdin/stdout to server
socat - TCP:127.0.0.1:54321,forever