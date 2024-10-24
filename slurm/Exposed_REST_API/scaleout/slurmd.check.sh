#!/bin/bash
exec 1> >(logger -s -t $(basename $0)) 2>&1

# Import our environment variables from systemd
# https://unix.stackexchange.com/questions/146995/inherit-environment-variables-in-systemd-docker-container
for e in $(tr "\000" "\n" < /proc/1/environ); do
        eval "export $e"
done

# always load on a cloud node
[ "$CLOUD" ] && exit 0

exec awk -vhost="$(hostname -s)" '
	BEGIN {rc = 1} 
	$1 == host {rc=0} 
	END {exit rc}
' /etc/nodelist
