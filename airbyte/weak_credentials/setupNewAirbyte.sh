#!/bin/bash

set -e

echo "An Automated Bash script for setting up a vulnerable airbyte instance that contains default login credentials"

echo "Updating package index..."
sudo apt-get update
command -v docker || {
  echo "Adding Docker's official GPG key..."
  sudo apt-get install -y ca-certificates curl
  sudo install -m 0755 -d /etc/apt/keyrings
  sudo curl -fsSL https://download.docker.com/linux/$(. /etc/os-release && echo "$ID")/gpg -o /etc/apt/keyrings/docker.asc
  sudo chmod a+r /etc/apt/keyrings/docker.asc

  echo "Adding the repository to Apt sources..."
  echo \
    "deb [arch=$(dpkg --print-architecture) signed-by=/etc/apt/keyrings/docker.asc] https://download.docker.com/linux/ubuntu \
    $(. /etc/os-release && echo "${UBUNTU_CODENAME:-$VERSION_CODENAME}") stable" | \
    sudo tee /etc/apt/sources.list.d/docker.list > /dev/null
  sudo apt-get update

  echo "Installing Docker..."
  sudo apt-get install docker-ce docker-ce-cli containerd.io docker-buildx-plugin docker-compose-plugin
  docker info || (echo "docker is not running" ; exit 1)

  echo "Adding current user to the 'docker' group..."
  sudo usermod -aG docker "$USER"
}

command -v minikube || {
  echo "Installing Minikube..."
  curl -LO https://storage.googleapis.com/minikube/releases/latest/minikube-linux-amd64 || (echo "can't download minikube" ; exit 1)
  mv minikube-linux-amd64 minikube
  chmod +x minikube
}

echo "Starting Minikube..."
./minikube start

echo "Downloading abctl..."
ls abctl || {
  curl -LO https://github.com/airbytehq/abctl/releases/download/v0.16.0/abctl-v0.16.0-linux-amd64.tar.gz || (echo "can't download abctl" ; exit 1)
  tar -xvzf abctl-v0.16.0-linux-amd64.tar.gz
  mv abctl-v0.16.0-linux-amd64/abctl .
  rm -r abctl-v0.16.0-linux-amd64
  rm abctl-v0.16.0-linux-amd64.tar.gz
}

echo "Uninstalling any previous Airbyte installation..."
./abctl local uninstall
rm -r ~/.airbyte

echo "Installing Airbyte..."
./abctl local install --chart-version=0.422.2