# Common setup for both vulnerable and secure K8s Dashboard
```bash
bash setup.sh
```
PLEASE BE PATIENT: Kubernetes Dashboard may need a few minutes to get up and become ready.

## Vulnerable(Exposed-UI) Kubernetes Dashboard
This will spin up an instance of Kubernetes Dashboard v2.7.0+0.g42deb6b32 with Authentication disabled.
The setup targets Linux amd64 and needs docker to run the exposed kubernetes dashboard.
```bash
kubectl -n kubernetes-dashboard port-forward svc/kubernetes-dashboard 8100:80
```
Ref: https://minikube.sigs.k8s.io/docs/start/?arch=%2Flinux%2Fx86-64%2Fstable%2Fbinary+download#Service

Ref: https://minikube.sigs.k8s.io/docs/handbook/dashboard/

### Exploitation steps
1. Start the vulnerable kubernetes dashboard
2. Get the port number of the kubernetes dashboard service and replace it in the command below (8100 is default)
```bash
bash exploit.sh 8100
bash cleanup.sh 8100
```
Or you can upload the `config.yaml` file to the kubernetes dashboard at http://127.0.0.1:8100/#/workloads?namespace=default and run the exploit from there.

## Secure K8s Dashboard with Authentication enabled
The setup targets Linux amd64 and needs docker to run the exposed kubernetes dashboard.
```bash
kubectl -n kubernetes-dashboard port-forward svc/kubernetes-dashboard-kong-proxy 8443:443
```
### Exploitation steps
Note that since this is secure, you will need to log in to the dashboard at https://127.0.0.1:8443.
By running the exploit script, you will receive "Failed to extract CSRF token." error message which is expected since the dashboard is secured by authentication now.
1. Start the secure kubernetes dashboard
2. Get the port number of the kubernetes dashboard service and replace it in the command below (8443 is default)
```bash
bash exploit.sh 8443
bash cleanup.sh 8443
```
You will receive "Failed to extract CSRF token." error message. Also, by visiting the dashboard at https://127.0.0.1:8443, you will need to log in.