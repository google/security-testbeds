#!/bin/bash

# sed -i 's/# auth-enabled = false/auth-enabled = true/' /etc/influxdb/influxdb.conf 

influxd > /logs/$(date +%s).log 2>&1 &

INFLUXDB_HOST="127.0.0.1"  
INFLUXDB_PORT="8086"       
USER="admin"

PASSWORD=$DB_PASSWD  
DATABASE_NAME=$AUTHFLAG

sleep 2

echo "CREATE USER ${USER} WITH PASSWORD '${PASSWORD}' WITH ALL PRIVILEGES" | influx -host ${INFLUXDB_HOST} -port ${INFLUXDB_PORT} > /dev/null 2>&1 
echo "CREATE DATABASE ${DATABASE_NAME}" | influx -host ${INFLUXDB_HOST} -port ${INFLUXDB_PORT} -username ${USER} -password ${PASSWORD} > /dev/null 2>&1 

socat - TCP:127.0.0.1:8086,forever 