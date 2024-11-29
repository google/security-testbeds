#!/bin/bash

echo $ROOTFLAG > /flag/flag.txt

/usr/sbin/apache2ctl -D FOREGROUND > /logs/$(date +%s).log 2>&1 &

# Proxy stdin/stdout to web server
socat - TCP:chal-wordpress.internet-ctf.kctf.cloud:1337,forever