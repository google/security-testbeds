#!/bin/bash
#exec 1> >(logger -s -t influxdb-setup) 2>&1

function pingit
{
	influx v1 auth list 1>&2

	echo $?
}

#wait until the daemon is responding
while [ $(pingit) != 0 ]
do
	sleep 0.1
done

sleep 2

B=$(while true
do
	influx bucket list 2>/dev/null >/tmp/buckets
	B=$(awk '
	BEGIN { rc = 1 }
	/scaleout/ {
		if (length($1) > 5 && $1 !~ /Error/) {
			print $1; rc = 0
		}
	}
	END {exit rc}
	' </tmp/buckets)
	[ $? -eq 0 ] && echo "$B" && break
	sleep 0.1
done)

echo "Found bucket: $B"

influx v1 dbrp create \
	--db scaleout --rp scaleout \
	--bucket-id $B \
	--default

influx v1 auth create \
	-c default \
	-d "slurm user" \
	--org scaleout \
	--password "password" \
	--username "user" \
	--write-bucket $B \
	--read-bucket $B

influx v1 auth create \
	-c default \
	-d "slurm user" \
	--org scaleout \
	--no-password \
	--username "admin" \
	--write-bucket $B \
	--read-bucket $B
