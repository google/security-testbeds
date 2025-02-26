#!/usr/bin/env bash
set -e

source venv/bin/activate

# Run the server
echo "Running the server:"
python3 pyZMQ_server.py