#!/bin/bash

set -e

echo "An Automated Bash script for setting up a vulnerable airbyte instance that contains default login credentials"

echo "Updating package index..."
sudo apt-get update

echo  "Add Docker's official GPG key..."
sudo apt-get update
sudo apt-get install ca-certificates curl
sudo install -m 0755 -d /etc/apt/keyrings
sudo curl -fsSL https://download.docker.com/linux/ubuntu/gpg -o /etc/apt/keyrings/docker.asc
sudo chmod a+r /etc/apt/keyrings/docker.asc

echo  "Add the repository to Apt sources..."
echo \
  "deb [arch=$(dpkg --print-architecture) signed-by=/etc/apt/keyrings/docker.asc] https://download.docker.com/linux/ubuntu \
  $(. /etc/os-release && echo "$VERSION_CODENAME") stable" | \
  sudo tee /etc/apt/sources.list.d/docker.list > /dev/null
sudo apt-get update

echo "Installing Docker..."
sudo apt-get install docker-ce docker-ce-cli containerd.io docker-buildx-plugin docker-compose-plugin
docker info || (echo "${RED}docker is not running" ; exit 1)

echo "Adding current user to the 'docker' group..."
sudo usermod -aG docker "$USER"

echo "Installing Minikube..."
curl -LO https://storage.googleapis.com/minikube/releases/latest/minikube-linux-amd64 || (echo "${RED}can't download minikube" ; exit 1)
sudo install minikube-linux-amd64 /usr/local/bin/minikube
rm minikube-linux-amd64

echo "Starting Minikube..."
minikube start

echo "Adding alias for kubectl..."
echo 'alias kubectl="minikube kubectl --"' >> ~/.bashrc
source ~/.bashrc

echo "Downloading abctl..."
curl -LO https://github.com/airbytehq/abctl/releases/download/v0.16.0/abctl-v0.16.0-linux-amd64.tar.gz || (echo "${RED}can't download abctl" ; exit 1)
tar -xvzf abctl-v0.16.0-linux-amd64.tar.gz
sudo mv abctl-v0.16.0-linux-amd64/abctl /usr/local/bin/
rm -rf abctl-v0.16.0-linux-amd64 abctl-v0.16.0-linux-amd64.tar.gz
sudo chmod +x /usr/local/bin/abctl

echo "Uninstalling any previous Airbyte installation..."
abctl local uninstall

echo "Installing Airbyte..."
abctl local install

echo "Setting up credentials for an insecure instance..."
abctl local credentials --email user@company.example
abctl local credentials --password new_password

echo "Installation completed! Access Airbyte at http://localhost:8000"

echo "Enter user@company.example/new_password as username/password."