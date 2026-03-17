#!/bin/bash

set -e

echo "Installation completed! Access Airbyte at http://localhost:8000"
echo "Please make sure you have completed the initial setup of Airbyte before running further tests."
echo "Below is the random Password for the Airbyte instance:"
./abctl local credentials