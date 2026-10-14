# Flowise Exposed UI

This directory contains the deployment config for Flowise instances with and without authentication.

## Deployment

```sh
docker-compose up
```
The vulnerable service will be exposed at port `8081` and the safe service will be exposed at port `8082`.


## Vulnerable Service
The `vuln` service runs Flowise v1.6.0 without authentication.

## Fixed Service
The `safe` service runs Flowise v1.6.1 with authentication enabled.
