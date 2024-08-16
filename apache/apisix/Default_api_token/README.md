# Apache APISIX Default API Token


This directory contains the deployment configs for an Apache APISIX installation
Apache APISIX has a built-in default API KEY. If the user does not proactively modify it (which few will), Lua scripts
can be executed directly through the API interface, which can lead to RCE vulnerabilities.

The deployed service has name `apache-apisix-defaul-api-token` and listens on port`9080`.

The container that is not affected by the vulnerability is `apache-apisix-defaul-api-token-safe`,you can use it `docker-compose -f docker-compose-safe.yml up -d` to start the container, and the service listens on port `9081`.
