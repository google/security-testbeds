# Apache APISIX Default API Token


This directory contains the deployment configs for an Apache APISIX installation
Apache APISIX has a built-in default API KEY. If the user does not proactively modify it (which few will), Lua scripts
can be executed directly through the API interface, which can lead to RCE vulnerabilities.

You can start the vulnerable service by running the command `docker compose up -d`. The deployed container has name `apache-apisix-defaul-api-token` and listens on port `9080`.

The container that is not affected by the vulnerability is `apache-apisix-defaul-api-token-safe`, you can start it with `docker compose -f docker-compose-safe.yml up -d`, and the service listens on port `9081`.
