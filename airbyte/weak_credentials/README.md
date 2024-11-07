# setup requirements
I used ubuntu 22.10 as my OS.
1. Install docker.
2. k8s with minikube: https://minikube.sigs.k8s.io/docs/start/ (we can use original k8s but this is an easy solution)
3. please don't forget to add `alias kubectl="minikube kubectl --"` to your shell environment.
4. download the `abctl` to manage the k8s easier. choose a compatible processor architecture from the release page: https://github.com/airbytehq/abctl/releases/tag/v0.16.0 
   ```bash
   # linux amd64
    curl https://github.com/airbytehq/abctl/releases/download/v0.16.0/abctl-v0.16.0-linux-amd64.tar.gz
    tar -xvzf abctl-v0.16.0-linux-amd64.tar.gz
    mv abctl-v0.16.0-linux-amd64/abctl .
    rm -rf abctl-v0.16.0-linux-amd64
    chmod +x abctl
    ```
Thanks to the James Fox(@jamesfoxxx) for the minikube setup guide.

# vulnerable instance
```bash
# clear the previous installation
./abctl local uninstall
./abctl local install
./abctl local credentials --email user@company.example
./abctl local credentials --password new_password
```
Go to http://localhost:8000/ and enter airbyte/password as username and password.

# secure instance
```bash
# clear the previous installation
./abctl local uninstall
./abctl local install
# get the random username and password
./abctl local credentials
```
Choose an email as a username and enter the random password that you received in a terminal. Since the password is random this is a secure airbyte instance. 