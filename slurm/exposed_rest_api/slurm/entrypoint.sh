#!/bin/bash
set -e

# Start munge
service munge start
sleep 1

# Start slurmctld and wait for it to start
/usr/sbin/slurmctld -i -Dvv &
sleep 2
until 2>/dev/null >/dev/tcp/127.0.0.1/6817
do
    echo "Waiting for slurmctld to start"
    sleep 2
done

# Start slurmd (worker process)
/usr/sbin/slurmd -Dvv &

# Start slurmrestd
export SLURM_JWT="daemon"
export SLURMRESTD_SECURITY="disable_unshare_files,disable_unshare_sysv,disable_user_check"
/usr/sbin/slurmrestd 0.0.0.0:6820 -a rest_auth/jwt -vv