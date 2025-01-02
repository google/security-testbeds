# Setup vulnerable and secure instances
On an Ubuntu 24.04 virtual machine:
```bash
bash start.sh
```
go to localhost:8080 for using a secure instance which has login and authentication enabled
go to localhost:8081 for using an exposed UI which authentication disabled

## clean up
cautions: it will remove all k8s cluster on minikube.
```bash
bash clean.sh
```


