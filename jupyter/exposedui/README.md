# Jupyter Notebook

This directory contains the deployment configs for a simple Jupyter Notebook
application. The service listens on port `80`.

This configs deploys the following services:

-   `jupyter`: the Jupyter Notebook application.


## Docker Compose
```
docker compose up
```

The vulnerable instance will run on port `8081` and the safe instance will run on port `8082`.