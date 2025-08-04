# Flowise UI Exposed

Flowise is a drag & drop UI tool for building LLM applications.
This testbed demonstrates vulnerable and non-vulnerable configurations of Flowise UI instances.

## Vulnerable Setup

The vulnerable setup exposes the Flowise UI without authentication:

```bash
docker compose --env-file env-default -p flowise-exposed up -d
```

## Non-vulnerable Setup

```bash
docker compose --env-file env-auth -p flowise-auth up -d
```

Application will be available at `http://localhost:3000/`
