# RCE in Kubernetes Cluster with Open Access

# Prerequisites

1. Install Docker

2. Download and install minikube suitable for required system/arch from:

`https://minikube.sigs.k8s.io/docs/start/`

E.g for Linux amd64 run:

```bash
curl -LO https://storage.googleapis.com/minikube/releases/latest/minikube-linux-amd64
sudo install minikube-linux-amd64 /usr/local/bin/minikube`
```

3. Run the cluster with:

`$ minikube start --driver=docker --force`

4. Create kubectl alias:

`alias kubectl="minikube kubectl --"`

5. Ensure that Kubernetes cluster is working with:

`kubectl get po -A`

6. To get IP of the cluster and URL of the Kubernetes API server run:

```bash
$ cat ~/.kube/config  | grep 'server: https:
    server: https://192.168.49.2:8443
```

or:

```bash
# minikube ip
192.168.49.2`
```


# Non-vulnerable testbed


1. Run the following command and notice that an anonymous user cannot access the API

```bash
% curl -k https://192.168.49.2:8443
{
  "kind": "Status",
  "apiVersion": "v1",
  "metadata": {},
  "status": "Failure",
  "message": "forbidden: User \"system:anonymous\" cannot get path \"/\"",
  "reason": "Forbidden",
  "details": {},
  "code": 403
}        
```

2. Alternatively run:

```# kubectl get pods --as=system:anonymous
Error from server (Forbidden): pods is forbidden: User "system:anonymous" cannot list resource "pods" in API group "" in the namespace "default"
```


# Vulnerable testbed


1. Configure kubernetes cluster to allow open access by creating a role to allow anonymous users accessing the API server with:

```bash
# kubectl create clusterrolebinding cluster-system-anonymous --clusterrole=cluster-admin --user=system:anonymous
clusterrolebinding.rbac.authorization.k8s.io/cluster-system-anonymous created
```

2. Confirm that the role with excessive privileges has been assigned to the system:anonymous with:

`kubectl get clusterrolebindings`


3. It should now be possible to access the API via curl:

```bash
$ curl -k https://192.168.49.2:8443
{
  "paths": [
    "/.well-known/openid-configuration",
    "/api",
    "/api/v1",
    "/apis",
...

```

or 

`$ kubectl get pods --as=system:anonymous`


4. To revert the vulnerable configuration to the non-vulnerable one remove the role with:

`$ kubectl delete clusterrolebinding cluster-system-anonymous`

5. To start from scratch, minikube can easily be deleted with:

`minkube delete`



