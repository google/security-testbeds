#!/bin/bash

logFolder="/chroot/home/model-server/logs"

now=$(date +%s)
cutoff=$((now - 3*60))

for file in "$logFolder"/*.log
do
    filename="${file##*/}"
    file_time="${filename%.log}"
    if [ $file_time -lt $cutoff ]; then
     cat "$file" 2>&1 | /usr/bin/logger -t cronjob
     rm "$file"
    fi
    unset filename file_time
    sleep 1
    cat /dev/null > /var/log/syslog
done