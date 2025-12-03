# Keycloak

This testbed creates a minimal keycloak instance to test for weak credentials

## Deploy

Deploy keycloak with the following command

```sh
docker compose up -d
```

You can then remove the instance with:

```sh
docker compose down
```

Credentials can be set customizing the `KC_BOOTSTRAP_ADMIN_USERNAME` and `KC_BOOTSTRAP_ADMIN_PASSWORD`.

The service will be served on <https://localhost:8080>
