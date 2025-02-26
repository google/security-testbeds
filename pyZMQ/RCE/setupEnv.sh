#!/usr/bin/env bash

set -e

# Install the required packages
sudo apt-get update
command -v python3 || sudo apt-get install python3
command -v python3-venv || sudo apt-get install python3-venv
command -v python3-pip || sudo apt-get install python3-pip

python3 -m venv venv
source venv/bin/activate
pip3 install pyzmq==26.2.1



