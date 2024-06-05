#!/bin/bash

#
# /home must be mounted in order to add users with correct UIDs
#
groupadd -g 1005 bedrock
cd /home
for i in $(ls); do
	TUID=$(stat -c %u /home/$i)
	/opt/rh/httpd24/root/usr/bin/htpasswd -b /opt/rh/httpd24/root/etc/httpd/.htpasswd $i password
	/usr/sbin/useradd -M -u $TUID -c $i -g users -G bedrock $i
done

#
# Clone over SSH config
#
for i in ssh_config ssh_host_ecdsa_key ssh_host_ecdsa_key.pub ssh_host_ed25519_key ssh_host_ed25519_key.pub ssh_host_rsa_key ssh_host_rsa_key.pub ssh_known_hosts sshd_config
do
	ln -nfs /etc/shared-ssh/$i /etc/ssh/$i
done

chmod 0664 /var/www/ood/apps/sys/myjobs/log/production.log

exec /usr/local/bin/launch-httpd


cd /var/www/ood/apps/sys/activejobs
scl enable rh-ruby22 -- bin/setup

