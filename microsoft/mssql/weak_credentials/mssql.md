# MSSQL
# Setup

1. Create docker image with this command: `docker run --name <name> -e "ACCEPT_EULA=Y" -e "MSSQL_SA_PASSWORD=<your pass>" -p 1433:1433 -d mcr.microsoft.com/mssql/server:2022-latest`
    * Note: Password requirement for root user: A strong system administrator (SA) password: At least 8 characters including uppercase, lowercase letters, base-10 digits and/or non-alphanumeric symbols.

2. Verify MSSQL is working as intended: `docker exec -it <name> /opt/mssql-tools/bin/sqlcmd -S <your ip> -U sa -P <your pass>`