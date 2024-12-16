# Requirements and Vulnerable kubeflow instance

1. install and run the minikube
    ```bash 
    curl -LO https://storage.googleapis.com/minikube/releases/latest/minikube-linux-amd64
    sudo install minikube-linux-amd64 /usr/local/bin/minikube && rm minikube-linux-amd64
    minikube start
    # you can put following in your .bashrc config to use it permanently
    alias kubectl="minikube kubectl --"
    ```
2. run the kubeflow with default credential
    ```bash
    # be sure if minikube is running
    minikube start

    rm -r manifests
    git clone https://github.com/kubeflow/manifests --depth 1 --branch v1.9.1
    cd manifests
    # download kustomize
    curl -s "https://raw.githubusercontent.com/kubernetes-sigs/kustomize/master/hack/install_kustomize.sh"  | bash
    while ! ./kustomize build example | kubectl apply --server-side --force-conflicts -f -; do echo "Retrying to apply resources"; sleep 20; done
    # wait (around 5m) until all Pods status become "Running"
    kubectl get pods -n kubeflow
    kubectl port-forward svc/istio-ingressgateway -n istio-system 8080:80
    ```
login with `user@example.com:12341234` as username:password.
# Secure kubeflow instance
please don't shut down the Vulnerable k8s setup. we can change the default password now.
   ```bash
   # the new random password is: xnYajo6i725voTQ
   kubectl delete secret dex-passwords -n auth
   kubectl create secret generic dex-passwords --from-literal=DEX_USER_PASSWORD='$2y$12$oZJNhGWWAA2DSTQEF0GfTeL0jufzk9EERDRwTrYAi.Ris7quLx4oG' -n auth
   kubectl delete pods --all -n auth
   # change back to the weak password(12341234):
   kubectl delete secret dex-passwords -n auth
   kubectl create secret generic dex-passwords 
   kubectl create secret generic dex-passwords --from-literal=DEX_USER_PASSWORD='$2y$12$sKB5soXKbQam1kM7z648l.Xss9xdM8vUgDOHOld8RqpVsWTtNwQ1y' -n auth
   kubectl delete pods --all -n auth
   ```