#!/usr/bin/env bash
set -e
echo "Setting up minikube"
ls minikube ||  curl -Lo minikube https://github.com/kubernetes/minikube/releases/download/v1.36.0/minikube-linux-amd64
chmod +x minikube
./minikube start
echo "Setting up helm"
curl -fsSL -o get_helm.sh https://raw.githubusercontent.com/helm/helm/main/scripts/get-helm-3
chmod 700 get_helm.sh
./get_helm.sh
helm repo add kubernetes-dashboard https://kubernetes.github.io/dashboard/
kubectl delete secret kubernetes-dashboard-csrf -n kubernetes-dashboard || echo "No csrf secret to delete"
echo "Installing kubernetes-dashboard with the helm"
helm upgrade --install kubernetes-dashboard kubernetes-dashboard/kubernetes-dashboard --create-namespace --namespace kubernetes-dashboard --set kong.admin.tls.enabled=false
./minikube dashboard --url &
PID=$!
sleep 3