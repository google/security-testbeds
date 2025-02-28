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
sudo sysctl fs.inotify.max_user_instances=1280
sudo sysctl fs.inotify.max_user_watches=655360

echo -e "\n${Green}Install curl and git ...${NC}\n"
sudo apt-get update
command -v git || sudo apt-get install -y git
command -v curl || sudo apt-get install -y curl

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
  sudo apt-get install docker-ce docker-ce-cli containerd.io docker-buildx-plugin docker-compose-plugin
  docker info 1>/dev/null || (echo -e "${RED}docker is not running${NC}" ; exit 1)
  sudo usermod -aG docker "$USER"
} || { echo -e "\n${RED}Failed to install Docker"; exit 1; }


echo -e "\n${Green}Install minikube ...${NC}\n"
ls minikube ||
{
    curl -LO https://storage.googleapis.com/minikube/releases/v1.34.0/minikube-linux-amd64
    mv minikube-linux-amd64 minikube
    chmod a+x minikube
}
./minikube status | grep "kubelet: Running" || ./minikube start \
    || { echo -e "\n${RED}Failed to install Minikube${NC}"; exit 1; }

echo -e "\n${Green}Install kubectl...${NC}\n"
ls kubectl ||
{
    curl -LO https://dl.k8s.io/release/v1.32.0/bin/linux/amd64/kubectl
    chmod a+x kubectl
} || { echo -e "\n${RED}Failed to install kubectl${NC}"; exit 1; }


echo -e "\n${Green}Install Kustomize ...${NC}\n"
ls kustomize || {
    curl --location --remote-name "https://github.com/kubernetes-sigs/kustomize/releases/download/kustomize%2Fv5.4.3/kustomize_v5.4.3_linux_amd64.tar.gz"
    tar -xzvf kustomize_v5.4.3_linux_amd64.tar.gz
    chmod a+x kustomize
} || { echo -e "\n${RED}Failed to install Kustomize${NC}"; exit 1; }


echo -e "\n${Green}Build and Apply manifests for pipelines... ${NC}\n"
{
    ./kustomize build example | ./kubectl apply --server-side --force-conflicts -f -
} || { echo -e "\n${RED}Failed to setup k8s pods ...${NC}\n"; exit 1; }

check_pods_running() {
  namespaces=(
    "cert-manager"
    "istio-system"
    "auth"
    "knative-serving"
    "kubeflow"
  )
  for ns in "${namespaces[@]}"; do
    pods=$(./kubectl get pods -n "$ns" --no-headers)
    if [ -z "$pods" ]; then
      echo "No pods found in namespace: $ns"
      return 1
    fi

    not_running=$(echo "$pods" | awk '{print $3}' | grep -v "Running")
    if [ -n "$not_running" ]; then
      echo "Not all pods are in Running state in namespace: $ns"
      return 0
    fi
  done
  echo "All pods are in Running state in all namespaces"
  return 1
}

echo -e "\n${Green}Wait until all pods get ready ...${NC}\n"
(
    while check_pods_running; do
      sleep 20
    done
)

echo -e "\n${Green}Port forward the dex login ...${NC}\n"
(
    ingress_gateway_service=$(./kubectl get svc --namespace istio-system --selector="app=istio-ingressgateway" --output jsonpath='{.items[0].metadata.name}')
    nohup ./kubectl port-forward --namespace istio-system svc/"${ingress_gateway_service}" 8080:80 &
) || { echo -e "\n${RED}Failed to port forward the kubeflow ...${NC}\n"; exit 1; }

echo -e "\n${Green}Go to http://localhost:8080 and login with \`user@example.com:12341234\` as username:password...${NC}\n"