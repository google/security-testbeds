#!/bin/bash

set -e

echo "Setting up credentials for an insecure instance..."
./abctl local credentials --email user@company.example
./abctl local credentials --password new_password

echo "Installation completed! Access Airbyte at http://localhost:8000"
echo "Please make sure you have completed the initial setup of Airbyte before running further tests."

echo "Enter user@company.example/new_password as username/password."