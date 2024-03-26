# Apache Spark Exposed API

This directory contains a docker-compose file which sets up an Apache Spark environment which exposes the Spark API to an unauthenticated attacker.

In the worst case such an exposed endpoint allows an unauthenticated attacker to execute arbitrary code by dynamically loading an attacker-controlled JAR and execute arbitrary code.

## Environment 

The deployed environment contains a Spark `master` node which exposes its' API endpoint on the default port `6066`.

The environment also contains a worker node which processes the attacker-submitted task.

The environment can be started with `docker compose up -d`
