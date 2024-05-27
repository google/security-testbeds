#!/bin/bash
#
# Script to setup for the QOS-based preemption lab

echo "PriorityWeightQOS=1000000" >> /etc/slurm/slurm.conf
/lab_scripts/restart.sh
sleep 3
#Create the QOSs:
sacctmgr -i add qos high
sacctmgr -i add qos medium
sacctmgr -i add qos low
# Assign all users, cluster and accounts to the low QOS, and make the low
# QOS the default for all users, cluster and accounts:
sacctmgr -i modify account bedrock set qos=low
sacctmgr -i modify user root,arnold,bambam,barney,betty,chip,dino,edna,fred,gazoo,pebbles,slurm,wilma set qos=low
sacctmgr -i modify cluster cluster set qos=low
sacctmgr -i modify account bedrock set defaultqos=low
sacctmgr -i modify cluster cluster set defaultqos=low

#Assign users to be able to use the QOSs:
sacctmgr -i modify user fred,barney set qos=+high,+medium,+low
sacctmgr -i modify user fred,barney,wilma,betty set qos=+medium,+low

