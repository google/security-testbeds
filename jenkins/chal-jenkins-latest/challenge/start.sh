#!/bin/bash

echo $ROOTFLAG > /flag/flag.txt

cp -a /jenkins_home/. /var/jenkins_home
sed -i "s@CODE@$PASS@g" /var/jenkins_home/users/Admin_17079489887775336508/config.xml

mkdir -p /var/jenkins_home/jobs/$AUTHFLAG
cp -a /example_job/. /var/jenkins_home/jobs/$AUTHFLAG


unset ROOTFLAG
unset AUTHFLAG
unset PASS


(/opt/java/openjdk/bin/java -jar usr/share/jenkins/jenkins.war) > /log/$(date +%s).log 2>&1 &

# Proxy stdin/stdout to server
socat - TCP:127.0.0.1:8080,forever



#/bin/bash -i