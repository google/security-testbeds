#!/bin/bash

echo $ROOTFLAG > /flag/flag.txt 

java -jar /h2o/h2o.jar -hash_login -login_conf /h2o/realm.properties  > /logs/$(date +%s).log 2>&1 &

# Proxy stdin/stdout to server
socat - TCP:127.0.0.1:54321,forever