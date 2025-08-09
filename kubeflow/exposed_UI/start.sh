#!/bin/bash
set -e
RED='\033[0;31m'
Green='\033[0;32m'
NC='\033[0m'

IS_DEBIAN=$(grep -q "Debian" /etc/os-release && echo "true" || echo "false")
IS_UBUNTU=$(grep -q "Ubuntu" /etc/os-release && echo "true" || echo "false")

if [ "$IS_DEBIAN" = "true" ] ; then
    echo -e "\n${Green}This is a Debian Distro${NC}\n"
elif [ "$IS_UBUNTU" = "true" ] ; then
    echo -e "\n${Green}This is a Ubuntu Distro${NC}\n"
else
    echo -e "\n${RED}This is not a Debian or Ubuntu Distro${NC}\n"
    exit 1
fi

echo -e "\n${Green}Increase inotify limits to prevent CrashLoopBackOff ...${NC}\n"
sudo sysctl fs.inotify.max_user_instances=2280
sudo sysctl fs.inotify.max_user_watches=1255360


echo -e "\n${Green}Install python3, python3-pip, python3-venv, wget and git ...${NC}\n"
sudo apt-get update
command -v git || sudo apt-get -y install git
command -v python3 || sudo apt-get -y install python3
command -v pip || sudo apt-get -y install python3-pip
python3 -m venv || sudo apt-get -y install python3-venv

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
    if [ "$IS_DEBIAN" = "true" ]; then
      sudo apt-get install -y ca-certificates curl
      sudo install -m 0755 -d /etc/apt/keyrings
      sudo curl -fsSL https://download.docker.com/linux/debian/gpg -o /etc/apt/keyrings/docker.asc
      sudo chmod a+r /etc/apt/keyrings/docker.asc
      echo  "Add the repository to Apt sources..."
      echo \
        "deb [arch=$(dpkg --print-architecture) signed-by=/etc/apt/keyrings/docker.asc] https://download.docker.com/linux/debian \
        $(. /etc/os-release && echo "$VERSION_CODENAME") stable" | \
        sudo tee /etc/apt/sources.list.d/docker.list > /dev/null
      fi
    if [ "$IS_UBUNTU" = "true" ]; then
      sudo apt-get install -y ca-certificates curl
      sudo install -m 0755 -d /etc/apt/keyrings
      sudo curl -fsSL https://download.docker.com/linux/ubuntu/gpg -o /etc/apt/keyrings/docker.asc
      sudo chmod a+r /etc/apt/keyrings/docker.asc
      echo  "Add the repository to Apt sources..."
      echo "deb [arch=$(dpkg --print-architecture) signed-by=/etc/apt/keyrings/docker.asc] https://download.docker.com/linux/ubuntu \
        $(. /etc/os-release && echo "$VERSION_CODENAME") stable" | \
        sudo tee /etc/apt/sources.list.d/docker.list > /dev/null
    fi
  sudo apt-get update
  sudo apt-get install -y docker-ce docker-ce-cli containerd.io docker-buildx-plugin docker-compose-plugin
  docker info 1>/dev/null || (echo -e "${RED}docker is not running${NC}" ; exit 1)
  sudo usermod -aG docker "$USER"
} || { echo -e "\n${RED}Failed to install Docker"; exit 1; }

echo pwd:  $(pwd)
echo -e "\n${Green}Install kind ...${NC}\n"
ls kind ||
{
    [ $(uname -m) = x86_64 ] && curl -Lo ./kind https://kind.sigs.k8s.io/dl/v0.29.0/kind-linux-amd64
    chmod +x kind
}

echo -e "\n${Green}Checking if a cluster named 'kubeflow' already exists...${NC}\n"
if ./kind get clusters | grep -q "^kubeflow$"; then
    echo -e "\n${Green}Cluster 'kubeflow' already exists. Skipping cluster creation steps.${NC}\n"
else
    echo -e "\n${Green}Cluster 'kubeflow' not found. Proceeding with cluster creation...${NC}\n"
    cat <<EOF | ./kind create cluster --name=kubeflow --config=-
kind: Cluster
apiVersion: kind.x-k8s.io/v1alpha4
nodes:
- role: control-plane
  image: kindest/node:v1.32.0@sha256:c48c62eac5da28cdadcf560d1d8616cfa6783b58f0d94cf63ad1bf49600cb027
  kubeadmConfigPatches:
  - |
    kind: ClusterConfiguration
    apiServer:
      extraArgs:
        "service-account-issuer": "https://kubernetes.default.svc"
        "service-account-signing-key-file": "/etc/kubernetes/pki/sa.key"
EOF
    ./kind get kubeconfig --name kubeflow > /tmp/kubeflow-config
    export KUBECONFIG=/tmp/kubeflow-config
fi

echo -e "\n${Green}We need to login into a docker account ...${NC}\n"
docker login

echo -e "\n${Green}Install kubectl...${NC}\n"
ls kubectl ||
{
    curl -LO https://dl.k8s.io/release/v1.32.0/bin/linux/amd64/kubectl
    chmod a+x kubectl
} || { echo -e "\n${RED}Failed to install kubectl${NC}"; exit 1; }

if ! ./kubectl get secret regcred >/dev/null 2>&1; then
    ./kubectl create secret generic regcred \
        --from-file=.dockerconfigjson=$HOME/.docker/config.json \
        --type=kubernetes.io/dockerconfigjson
fi


echo -e "\n${Green}Install Kustomize ...${NC}\n"
ls kustomize || {
    curl --location --remote-name "https://github.com/kubernetes-sigs/kustomize/releases/download/kustomize%2Fv5.4.3/kustomize_v5.4.3_linux_amd64.tar.gz"
    tar -xzvf kustomize_v5.4.3_linux_amd64.tar.gz
    chmod a+x kustomize
    rm kustomize_v5.4.3_linux_amd64.tar.gz
} || { echo -e "\n${RED}Failed to install Kustomize${NC}"; exit 1; }


echo -e "\n${Green}Build and Apply manifests for pipelines... ${NC}\n"
{
    while ! ./kustomize build example | ./kubectl apply --server-side --force-conflicts -f -; do echo "Retrying to apply resources"; sleep 20; done
} || { echo -e "\n${RED}Failed to setup k8s pods ...${NC}\n"; exit 1; }

echo -e "\n${Green}Port forward the dex login ...${NC}\n"
(
    ingress_gateway_service=$(./kubectl get svc --namespace istio-system --selector="app=istio-ingressgateway" --output jsonpath='{.items[0].metadata.name}')
      nohup ./kubectl port-forward --namespace istio-system svc/"${ingress_gateway_service}" 8080:80 &
) || { echo -e "\n${RED}Failed to port forward the kubeflow ...${NC}\n"; exit 1; }


cd ..
echo -e "\n${Green}Install python3 requirements ...${NC}\n"
(
    python3 -m venv .venv
    ./.venv/bin/pip3 install requests
) || { echo -e "\n${RED}Failed to install python3 packages...${NC}\n" ; exit 1; }

cookies=""

echo -e "\n${Green}Logging in and save an authenticated cookie ...${NC}\n"
{
    cookies=$(./.venv/bin/python3 test_dex_login.py)
} || { echo -e "\n${RED}Failed to get a valid session cookie ...${NC}\n"; exit 1; }


echo -e "\n${Green}Download caddy webserver to forward unauthenticated requests with cookie ...${NC}\n"
ls ./caddy ||
{
    wget https://github.com/caddyserver/caddy/releases/download/v2.8.4/caddy_2.8.4_linux_amd64.tar.gz
    tar -zxvf caddy_2.8.4_linux_amd64.tar.gz  caddy
    rm caddy_2.8.4_linux_amd64.tar.gz
    chmod +x caddy
}

echo -e "\n${Green}Run unauthenticated Proxy of the Kubeflow on http://localhost:8081 ...${NC}\n"
./caddy reverse-proxy --from :8081 --to http://localhost:8080 --header-up "Cookie: $cookies" --access-log \
      || { echo -e "\n${RED}Failed setup caddy server ...${NC}\n"; exit 1; }


