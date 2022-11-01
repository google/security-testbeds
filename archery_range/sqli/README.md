# Archery Range: SQLI Testbed

The application hosts SQLI tests for web-security vulnerability scanners.

It relies on a mysql and postgres db system running accessible to the
application that was initialized using the respective scripts under `database/`.
Connectivity to the DB's is done using environment parameters as per the
following command.

Install the requirements:
```sh
pip3 install -r requirements.txt
```

Run the SQLI testbed:
```sh
MYSQL_DB=archery_range MYSQL_USER=archery_range MYSQL_PASSWORD=<password> MYSQL_HOST=127.0.0.1 POSTGRES_DB=archery_range POSTGRES_USER=archery_range POSTGRES_PASSWORD=<password> POSTGRES_HOST=127.0.0.1 python3 app.py
```
