echo "We are inside the manifests repo now ..."

echo "Deletes the local Kubernetes cluster"
minikube delete

echo "Remove kubectl, minikube and kustomize ..."
sudo rm kubectl minikube kustomize caddy

