# Litmus Chaos

## Setup the testbed

Install minikube: <https://minikube.sigs.k8s.io/docs/start/?arch=%2Flinux%2Fx86-64%2Fstable%2Fbinary+download>

```sh
curl -LO https://github.com/kubernetes/minikube/releases/latest/download/minikube-linux-amd64
sudo install minikube-linux-amd64 /usr/local/bin/minikube && rm minikube-linux-amd64

minikube start --cpus=4 --memory=8192 --driver=docker
```

Install helm: <https://helm.sh/docs/intro/install/>

```sh
curl https://raw.githubusercontent.com/helm/helm/main/scripts/get-helm-4 | bash
```

Install litmus chaos: <https://docs.litmuschaos.io/docs/getting-started/installation#install-litmus-using-helm>

```sh
helm repo add litmuschaos https://litmuschaos.github.io/litmus-helm/
helm repo list
kubectl create ns litmus
helm install chaos litmuschaos/litmus --namespace=litmus \
  --set portal.frontend.service.type=NodePort \
  --set mongodb.persistence.enabled=false
```

Wait for pods: `kubectl get pods -n litmus -w`

Expose the service

```sh
kubectl port-forward -n litmus svc/chaos-litmus-frontend-service 9091:9091 --address 0.0.0.0 &
```

The service will be exposed on <http://localhost:9091>

## Stop the testbed

The service can be stopped and deleted with

```sh
helm uninstall chaos -n litmus
kubectl delete ns litmus
minikube delete --all
```
