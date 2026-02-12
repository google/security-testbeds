# Ollama Exposed API

This directory contains a docker-compose file which sets up an Ollama environment which exposes the Ollama API to an unauthenticated attacker.

In the worst case such an exposed endpoint allows an unauthenticated attacker to execute management tasks, such as downloading and replacing custom models.

Ollama itself does not offer an inbuilt authentication method for the API and relies on the user to not expose the API to insecure networks.

## Vulnerable Environment 

The deployed environment contains an Ollama service which exposes its API endpoint on the default port `11434`.

The environment can be started with `docker compose up -d`

To verify the vulnerability you can launch the following command:

```bash
curl http://localhost:11434/api/ps
```

## Safe Environment

Out of the box Ollama does not offer a fix for this vulnerability. According to the official documentation access to the API needs to be secured externally, for example by restricting access to the application through a reverse proxy.
