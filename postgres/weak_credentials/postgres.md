# Postgres
# Setup

1. Create docker image with this command: `docker run --name some-postgres -e POSTGRES_PASSWORD=mysecretpassword -d postgres:tag`

2. Verify Postgres is working as intended: `psql -h ip-addr -U postgres`