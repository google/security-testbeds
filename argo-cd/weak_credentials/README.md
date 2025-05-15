
# setup requirements
1. k8s with minikube: https://minikube.sigs.k8s.io/docs/start/ (we can use original k8s but this is a easy solution)
2. please don't forget to add alias kubectl="minikube kubectl --" to your shell environment.

# vulnerable instance
```bash
kubectl create namespace argocd
kubectl apply -n argocd -f https://raw.githubusercontent.com/argoproj/argo-cd/stable/manifests/install.yaml
# set default password for admin:
kubectl -n argocd patch secret argocd-secret \
  -p '{"stringData": {
      "admin.password": "$2a$10$hDj12Tw9xVmvybSahN1Y0.f9DZixxN8oybyA32Uy/eqWklFU4Mo8O",
      "admin.passwordMtime": "'$(date +%FT%T%Z)'"
  }}'
kubectl port-forward svc/argocd-server -n argocd 8082:443
```
Open your browser, go to the address https://127.0.0.1:8082, and enter the credentials `admin:Password1!` on the login page.

# secure instance
```bash
kubectl create namespace argocd
kubectl apply -n argocd -f https://raw.githubusercontent.com/argoproj/argo-cd/stable/manifests/install.yaml
kubectl port-forward svc/argocd-server -n argocd 8082:443
```

Open your browser, and go to the address https://127.0.0.1:8082, you can't use any default credentials, the new credentials are random.
