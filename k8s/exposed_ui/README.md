# Exposed Kubernetes Dashboard
This will spin up an instance of Kubernetes Dashboard v2.7.0+0.g42deb6b32 with Authentication disabled.
The setup targets Linux amd64 and needs docker to run the exposed kubernetes dashboard.
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
2. Get the port number of the kubernetes dashboard service and replace it in the command below (8100 is default)
```bash
bash exploit.sh 8100
bash cleanup.sh
```
Or you can upload the `config.yaml` file to the kubernetes dashboard at http://127.0.0.1:8100/api/v1/namespaces/kubernetes-dashboard/services/http:kubernetes-dashboard:/proxy/#/workloads?namespace=default and run the exploit from there.

# Secure K8s Dashboard with Login enabled

```bash
curl -Lo minikube https://github.com/kubernetes/minikube/releases/download/v1.36.0/minikube-linux-amd64
chmod +x minikube
./minikube start
# install helm charts
curl -fsSL -o get_helm.sh https://raw.githubusercontent.com/helm/helm/main/scripts/get-helm-3
chmod 700 get_helm.sh
./get_helm.sh
helm repo add kubernetes-dashboard https://kubernetes.github.io/dashboard/
kubectl delete secret kubernetes-dashboard-csrf -n kubernetes-dashboard
helm upgrade --install kubernetes-dashboard kubernetes-dashboard/kubernetes-dashboard --create-namespace --namespace kubernetes-dashboard --set kong.admin.tls.enabled=false
#NOTES:
#*************************************************************************************************
#*** PLEASE BE PATIENT: Kubernetes Dashboard may need a few minutes to get up and become ready ***
#*************************************************************************************************
kubectl -n kubernetes-dashboard port-forward svc/kubernetes-dashboard-kong-proxy 8443:443
```
## Exploitation steps
1. Start the secure kubernetes dashboard
2. Get the port number of the kubernetes dashboard service and replace it in the command below (8443 is default)
```bash
bash exploit.sh 8443
bash cleanup.sh
```
you will receive "Failed to extract CSRF token." error message. Also, by visiting the dashboard at https://127.0.0.1:8443, you will need to log in.