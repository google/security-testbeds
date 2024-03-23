#!/bin/bash

# Start web server if it is not running

(java -jar usr/share/jenkins/jenkins.war) > /dev/null 2>&1 &

/usr/sbin/sshd -f /home/user/etc/sshd_config -D &

# Proxy stdin/stdout to ssh port
socat - TCP:127.0.0.1:2022,forever