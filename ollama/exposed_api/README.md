# Ollama Exposed API

This directory contains a docker-compose file which sets up an Ollama environment which exposes the Ollama API to an unauthenticated attacker.

In the worst case such an exposed endpoint allows an unauthenticated attacker to execute management tasks, such as downloading and replacing custom models.

Ollama itself does not offer an inbuilt authentication method for the API and relies on the user to not expose the API to insecure networks.

## Environment 

The deployed environment contains an Ollama service which exposes its' API endpoint on the default port `11434`.

The environment can be started with `docker compose up -d`
