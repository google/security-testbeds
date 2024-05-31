#!/bin/sh

/usr/local/tomcat/bin/catalina.sh run > /dev/null 2>&1 &

socat - TCP:127.0.0.1:8080,forever