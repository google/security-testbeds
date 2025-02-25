#!/bin/bash
java -Djava.library.path=/opt/h2oai/h2o-3/xgb_lib_dir -XX:+UseContainerSupport -XX:MaxRAMPercentage=50 -jar /opt/h2oai/h2o-3/h2o.jar  1>&2 &

/home/user/socat TCP:127.0.0.1:54321,retry,forever stdio