# setup anonymous admin access for all versions 

```bash
kubectl create namespace argocd
kubectl apply -n argocd -f https://raw.githubusercontent.com/argoproj/argo-cd/stable/manifests/install.yaml
kubectl patch -n argocd cm argocd-cm -p '{"data":{"users.anonymous.enabled":"true"}}'
kubectl patch -n argocd cm argocd-rbac-cm -p '{"data":{"policy.default":"role:admin"}}'
```

give access to the server from 127.0.0.1:8082 for testing the plugin:
`kubectl port-forward svc/argocd-server -n argocd 8082:443`
