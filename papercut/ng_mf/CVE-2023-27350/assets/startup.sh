#!/bin/bash

service cups start

# Port Forwarding
# myip=$(hostname -i)
# /sbin/iptables -t nat -I PREROUTING --src 0/0 --dst $myip -p tcp --dport 80 -j REDIRECT --to-ports 9191
# /sbin/iptables -t nat -I PREROUTING --src 0/0 --dst $myip -p tcp --dport 443 -j REDIRECT --to-ports 9192

/etc/init.d/papercut console