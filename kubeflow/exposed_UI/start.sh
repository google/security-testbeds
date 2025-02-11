#!/bin/bash
set -e
RED='\033[0;31m'
Green='\033[0;32m'
NC='\033[0m'

echo -e "\n${Green}Install python3, python3-pip, python3-venv, wget and git ...${NC}\n"
sudo apt update
command -v git || sudo apt install git
command -v python3 || sudo apt install python3
command -v pip || sudo apt install python3-pip
python3 -m venv || sudo apt install python3-venv

echo -e "\n${Green}Clone manifests repo ...${NC}\n"
{
    if test -d manifests; then
      cd manifests
      git add .
      git reset HEAD --hard
      cd ..
    else
     git clone -b v1.9.1-branch https://github.com/kubeflow/manifests
    fi
} || { echo -e "\n${RED}Failed to clone the manifests...${NC}\n"; exit 1; }

cd manifests || exit 1;
echo -e "\n${Green}We are inside the manifests repo now ...${NC}\n"

echo -e "\n${Green}Install Docker ...${NC}\n"
command -v docker ||
{
  sudo apt-get install ca-certificates curl
  sudo install -m 0755 -d /etc/apt/keyrings
  sudo curl -fsSL https://download.docker.com/linux/ubuntu/gpg -o /etc/apt/keyrings/docker.asc
  sudo chmod a+r /etc/apt/keyrings/docker.asc
  echo  "Add the repository to Apt sources..."
  echo "deb [arch=$(dpkg --print-architecture) signed-by=/etc/apt/keyrings/docker.asc] https://download.docker.com/linux/ubuntu \
    $(. /etc/os-release && echo "$VERSION_CODENAME") stable" | \
    sudo tee /etc/apt/sources.list.d/docker.list > /dev/null
  sudo apt-get update
  sudo apt-get install docker-ce docker-ce-cli containerd.io docker-buildx-plugin docker-compose-plugin
  docker info 1>/dev/null || (echo -e "${RED}docker is not running${NC}" ; exit 1)
  sudo usermod -aG docker "$USER"
} || { echo -e "\n${RED}Failed to install Docker"; exit 1; }

echo -e "\n${Green}Install minikube ...${NC}\n"
command -v minikube ||
{
    curl -LO https://storage.googleapis.com/minikube/releases/v1.34.0/minikube-linux-amd64
    mv minikube-linux-amd64 minikube
    chmod a+x minikube
    sudo mv minikube /usr/local/bin
}
minikube status | grep "kubelet: Running" || minikube start \
    || { echo -e "\n${RED}Failed to install Minikube${NC}"; exit 1; }

echo -e "\n${Green}Install kubectl...${NC}\n"
command -v kubectl ||
{
    curl -LO https://dl.k8s.io/release/v1.32.0/bin/linux/amd64/kubectl
    chmod a+x kubectl
    sudo mv kubectl /usr/local/bin
} || { echo -e "\n${RED}Failed to install kubectl${NC}"; exit 1; }


echo -e "\n${Green}Install Kustomize ...${NC}\n"
command -v kustomize || {
    curl --silent --location --remote-name "https://github.com/kubernetes-sigs/kustomize/releases/download/kustomize%2Fv5.4.3/kustomize_v5.4.3_linux_amd64.tar.gz"
    tar -xzvf kustomize_v5.4.3_linux_amd64.tar.gz
    chmod a+x kustomize
    sudo mv kustomize /usr/local/bin
} || { echo -e "\n${RED}Failed to install Kustomize${NC}"; exit 1; }


echo -e "\n${Green}Build and Apply manifests for pipelines... ${NC}\n"
{
    while ! kustomize build example | kubectl apply --server-side --force-conflicts -f -; do echo "Retrying to apply resources"; sleep 20; done
} || { echo -e "\n${RED}Failed to setup k8s pods ...${NC}\n"; exit 1; }

echo -e "\n${Green}Port forward the dex login ...${NC}\n"
(
    ingress_gateway_service=$(kubectl get svc --namespace istio-system --selector="app=istio-ingressgateway" --output jsonpath='{.items[0].metadata.name}')
        nohup kubectl port-forward --namespace istio-system svc/"${ingress_gateway_service}" 8080:80 &
        while ! curl localhost:8080; do echo waiting for port-forwarding; sleep 1; done; echo port-forwarding ready
) || { echo -e "\n${RED}Failed to port forward the kubeflow ...${NC}\n"; exit 1; }


echo -e "\n${Green}Install python3 requirements ...${NC}\n"
(
    python3 -m venv .venv
    ./.venv/bin/pip3 install requests
) || { echo -e "\n${RED}Failed to install python3 packages...${NC}\n" ; exit 1; }

cookies=""

echo -e "\n${Green}Logging in and save an authenticated cookie ...${NC}\n"
{
    echo -e "\nprint(session_cookies)" >> tests/gh-actions/test_dex_login.py
    cookies=$(./.venv/bin/python3 tests/gh-actions/test_dex_login.py)
} || { echo -e "\n${RED}Failed to get a valid session cookie ...${NC}\n"; exit 1; }


echo -e "\n${Green}Download caddy webserver to forward unauthenticated requests with cookie ...${NC}\n"
command -v caddy ||
{
    wget https://github.com/caddyserver/caddy/releases/download/v2.8.4/caddy_2.8.4_linux_amd64.tar.gz
    tar -zxvf caddy_2.8.4_linux_amd64.tar.gz  caddy
    sudo mv caddy /usr/local/bin
}

echo -e "\n${Green}Run unauthenticated Proxy of the Kubeflow on http://localhost:8081 ...${NC}\n"
caddy reverse-proxy --from :8081 --to http://localhost:8080 --header-up "Cookie: $cookies" --access-log \
      || { echo -e "\n${RED}Failed setup caddy server ...${NC}\n"; exit 1; }


