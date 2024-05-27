#!/bin/bash

echo "--------------------------"
echo "Starting controller daemon"
echo "--------------------------"
ssh mgmtnode systemctl restart slurmctld
# Make sure the controller daemon is running..
until ssh mgmtnode '(ps -ef|grep -v grep|grep slurmctld)' ; do
   sleep 1
done
# Add an additional, tunable delay in seconds, just to be sure...
TD=3
echo -n "Slight delay of $TD seconds"
for x in $(seq 1 $TD) ; do
   echo -n .
done
echo

echo "---------------------"
echo "Starting slurm daemon"
echo "---------------------"
pdsh systemctl restart slurmd
# Make sure the slurmd daemon is running..
until ssh node01 '(ps -ef|grep -v grep|grep slurmd)' ; do
   sleep 1
done
# Add an additional, tunable delay in seconds, just to be sure...
TD=3
echo -n "Slight delay of $TD seconds"
for x in $(seq 1 $TD) ; do
   echo -n .
done
echo

echo "-----------------------------------"
echo "Updating state of nodes to 'resume'"
echo "-----------------------------------"
scontrol update nodename=node[00-09] state=resume 2>/dev/null

exit
