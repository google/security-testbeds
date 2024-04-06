# setup requirements
1. k8s with minikube: https://minikube.sigs.k8s.io/docs/start/ (we can use original k8s but this is a easy solution)
2. please don't forget to add `alias kubectl="minikube kubectl --"` to your shell environment.

# vulnerable instance
## install argo workflows
```bash
kubectl create namespace argo
kubectl apply -n argo -f https://github.com/argoproj/argo-workflows/releases/download/v3.5.5/install.yaml
```
## remove authentication
```bash
kubectl patch deployment argo-server --namespace argo  --type='json' -p='[{"op": "replace", "path": "/spec/template/spec/containers/0/args", "value": ["server","--auth-mode=server"]}]'
```

## allow Argo to interact with the resources in your Kubernetes cluster with admin-level privileges
```bash
kubectl create rolebinding argo-default-admin --clusterrole=admin --serviceaccount=argo:default -n argo
```
## Expose the UI to localhost
```bash
kubectl -n argo port-forward deployment/argo-server 2746:2746
```
