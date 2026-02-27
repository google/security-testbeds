echo "We are inside the manifests repo now ..."

echo "Deletes the local kubeflow cluster"
./kind delete cluster --name kubeflow || { echo -e "\nFailed to delete the cluster..."; exit 1; }

