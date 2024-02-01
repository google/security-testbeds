#!/bin/bash

#puts flag in html page if it is not there
FLAG=$( < /flag/flag)
if ! grep -q $FLAG /usr/local/lib/python3.8/dist-packages/jupyter_server/templates/page.html; then
	sed -i 26r/flag/flag /usr/local/lib/python3.8/dist-packages/jupyter_server/templates/page.html;
fi
unset FLAG


# Start node web server
/usr/local/bin/jupyter-notebook > /dev/null 2>&1 &


# Proxy stdin/stdout to server
socat - TCP:127.0.0.1:8888,forever
