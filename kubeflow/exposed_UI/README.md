# Setup Vulnerable and Secure Instances

1. Download Ubuntu Server 24.04.2 LTS from here: https://ubuntu.com/download/server#manual-install
2. install it using virtualbox or KVM or ..
3. during the installation:
    1. remember the IP address of machine
    2. install openssh-server without any configuration
    3. don't install any additional softwares like docker microk8s and ... we will install it with `start.sh` script
    4. (optional) enable ssh to be able to do copy/pastes
        ```bash
        sudo bash -c 'cat <<EOT > /etc/ssh/sshd_config
        PasswordAuthentication yes
        PermitRootLogin yes
        EOT'
        sudo systemctl restart ssh
        ```
4. make sure you give the Ubuntu server at least 60GB storage and 12GB RAM.
5. run the following
    ```bash
    bash start.sh
    ```

6. Access the secure instance with login and authentication enabled at http://localhost:8080. Access the exposed UI,
   which has authentication disabled and is vulnerable to attacks, at http://localhost:8081. You can create and run a
   new pipeline here.

## clean up

Caution: This will remove all Kubernetes clusters on Minikube.

```bash
bash clean.sh
```
