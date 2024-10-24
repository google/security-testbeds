#!/bin/bash
munged --num-threads=10
postfix -Dv start
systemctl enable podman
systemctl start podman

for i in arnold bambam barney betty chip dino edna fred gazoo pebbles wilma; do
	loginctl enable-linger $i
done

exec /usr/sbin/sshd -D
