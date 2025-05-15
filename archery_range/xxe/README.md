# Archery Range: XXE Testbed

The application hosts XXE tests for web-security vulnerability scanners.

Most XML parsing libraries do correctly handle XML input and disable features
such as entity expansion by default. Some even no longer allow to set insecure
parsing modes at all. Thus, this testbed application is a simple wrapper around
`xmllint` which can be configured insecurely by passing the `--noent` command
line flag.

The testbed requires the system to have the `xmllint` utility installed.

Install the requirements:
```sh
pip3 install -r requirements.txt
sudo apt update && apt install libxml2-utils
```

Run the XXE testbed:
```sh
python3 app.py
```
