# n8n Exposed REST API

n8n is a workflow automation platform that allows users to create and execute automated workflows.
This testbed demonstrates exposed and properly secured configurations of the n8n REST API.

## Safe setup

```shell
docker compose -f docker-compose-non-vuln.yml up -d
```
This configuration enforces authentication and prevents unauthorized access to the REST API.

## Vulnerable setup

```shell
docker compose -f docker-compose-vuln.yml up -d
```
This configuration exposes the REST API without authentication, allowing unauthorized access.

## Notes

- In older versions, exposure may occur when authentication is disabled.
- In newer versions, this issue is often caused by misconfigurations such as improperly secured reverse proxies.

## References

- https://github.com/n8n-io/n8n
- https://docs.n8n.io/hosting/securing/overview/
