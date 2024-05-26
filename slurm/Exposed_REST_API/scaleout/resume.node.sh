#!/bin/bash
exec 1> >(logger -s -t $(basename $0)) 2>&1

[ ! -S /run/cloud_socket ] && exit -1

scontrol show hostnames $1 | while read nodename
do
	resp=$(echo "start:$nodename" | socat -t9999 STDIO UNIX-CONNECT:/run/cloud_socket)

	[ "$resp" != "ACK" ] && exit 1
done

true
