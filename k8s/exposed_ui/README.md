# Vulnerable Kubernetes Dashboard
we need docker to run the vulnerable kubernetes dashboard
```bash
curl -Lo minikube https://github.com/kubernetes/minikube/releases/download/v1.36.0/minikube-linux-amd64
chmod +x minikube
./minikube start
./minikube dashboard  --port=8100
```
Ref: https://minikube.sigs.k8s.io/docs/start/?arch=%2Flinux%2Fx86-64%2Fstable%2Fbinary+download#Service

Ref: https://minikube.sigs.k8s.io/docs/handbook/dashboard/

## Exploitation steps
1. Start the vulnerable kubernetes dashboard
2. Get the port number of the kubernetes dashboard service and replace it in the curl commands below
```bash
bash exploit.sh
bash cleanup.sh
```
Or you can upload the `config.yaml` file to the kubernetes dashboard at http://127.0.0.1:8100/api/v1/namespaces/kubernetes-dashboard/services/http:kubernetes-dashboard:/proxy/#/workloads?namespace=default and run the exploit from there.