#!/bin/bash

now=$(date +%s)
touch /logs/${now}.log > /dev/null
/usr/local/tomcat/bin/catalina.sh run >> /logs/${now}.log 2>&1 &

socat - TCP:127.0.0.1:8080,forever