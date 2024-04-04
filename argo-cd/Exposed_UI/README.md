# setup anonymous admin access for all versions 

```bash
kubectl create namespace argocdexposed
kubectl apply -n argocdexposed -f https://raw.githubusercontent.com/argoproj/argo-cd/v2.3.4/manifests/install.yaml
kubectl edit -n argocdexposed cm argocd-cm -o yaml
```

append the following:
```yaml
data:
  users.anonymous.enabled: "true"
```

`kubectl edit -n argocdexposed cm argocd-rbac-cm -o yaml`

append the following:
```yaml
data:
  policy.default: role:admin
```
give access to the server from 127.0.0.1:8082 for testing the plugin:
`kubectl port-forward svc/argocd-server -n argocdexposed 8082:443`
