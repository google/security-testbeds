#!/bin/sh
(set -e)

# Apache gets grumpy about PID files pre-existing
(rm -f /usr/local/apache2/logs/httpd.pid) &

(/usr/local/apache2/bin/httpd -DFOREGROUND "$@") > /logs/$(date +%s).log 2>&1 &
socat - TCP:127.0.0.1:8080,forever 