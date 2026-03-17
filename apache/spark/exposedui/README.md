# Apache Spark Exposed Web UI

This directory contains a docker-compose file which sets up an Apache Spark environment which exposes it's web UI to an unauthenticated attacker.

In the worst case such an exposed endpoint allows an unauthenticated attacker to retrieve data about tasks run by the server.

## Environment 

The deployed environment contains a Spark `master` node which exposes its web UI on the default port `8080`.

The environment can be started with `docker compose up -d`
