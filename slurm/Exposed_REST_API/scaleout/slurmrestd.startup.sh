#!/bin/bash

mkdir -p -m 0755 /run/slurm
chown slurmrestd:slurmrestd -R /run/slurm

#wait until config is filled out by controller before starting
while [ ! -s /etc/slurm/nodes.conf ]
do
	sleep 0.25
done

exit 0
