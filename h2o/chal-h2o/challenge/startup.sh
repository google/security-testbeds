#!/bin/bash

java -jar /h2o-3.46.0.1/h2o.jar -hash_login -login_conf /h2o-3.46.0.1/realm.properties > /dev/null 2>&1 &
#java -jar /h2o-3.46.0.1/h2o.jar > /dev/null 2>&1 &
# Proxy stdin/stdout to server
socat - TCP:127.0.0.1:54321,forever