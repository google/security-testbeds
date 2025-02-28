# Setup Vulnerable and Secure Instances

Please make sure you have deleted the existing minikube cluster: `minikube delete --all` this is to avoid any conflicts
with the new cluster.

On an Ubuntu 24.04 virtual machine, run:

```bash
bash start.sh
```

Access the secure instance with login and authentication enabled at http://localhost:8080.

Access the exposed UI, which has authentication disabled and is vulnerable to attacks, at http://localhost:8081. You can
create and run a new pipeline here.

## clean up

Caution: This will remove all Kubernetes clusters on Minikube.

```bash
bash clean.sh
```
