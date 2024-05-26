#!/bin/bash
while [ ! -s /etc/slurm/nodes.conf ]
do
	sleep 0.25
done

scontrol token username=slurm lifespan=9999999 | sed 's#SLURM_JWT=##g' > /auth/slurm
chmod 0755 -R /auth

sed -e '/^hosts:/d' -i /etc/nsswitch.conf
echo 'hosts:      files dns myhostname' >> /etc/nsswitch.conf

exit 0
