cd manifests
echo "We are inside the manifests repo now ..."

echo "Deletes the local Kubernetes cluster"
minikube delete

echo "Remove manifests directory ..."
cd ..
sudo rm -r manifests

