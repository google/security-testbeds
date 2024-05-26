#!/bin/bash
exec 1> >(logger -s -t $(basename $0)) 2>&1

function getmip
{
	#Avoid IPv6 until bug#11321 is resolved

	getent ahostsv4 mgmtnode | awk '
		$2 == "STREAM" && $1 !~ /:/ {
			print $1
			exit 0
		}
	'
}

function getip
{
	ip route get $(getmip) |  awk '
		{
			for (i = 1; i <= NF; i++) {
				if ($i == "src") {
					print $(i+1)
				}
			}
		}
	'
}

# Import our environment variables from systemd
# https://unix.stackexchange.com/questions/146995/inherit-environment-variables-in-systemd-docker-container
for e in $(tr "\000" "\n" < /proc/1/environ); do
        eval "export $e"
done

while [ ! -s /etc/slurm/nodes.conf ]
do
        sleep 0.25
done

[ "$CLOUD" -a ! -f /etc/cloud-configured ] && \
	while true
	do
			#init this cloud node
			host="$(echo "whoami:$(hostname)" | socat -t999 STDIO UNIX-CONNECT:/run/cloud_socket)"

			[ -z "$host" -o "$host" == "FAIL" ] && sleep 0.25 && continue

			src=$(getip)

			hostname $host
			echo "$host" > /etc/hostname
			hostnamectl set-hostname "$host"
			scontrol update nodename=$host nodeaddr=$src nodehostname=$src
			echo "Sending nodename=$host nodeaddr=$src nodehostname=$src"

			systemctl daemon-reload

			touch /etc/cloud-configured

			exit 0
	done

exit 0
