# vulnerable instance
on ubuntu 22.04:
```bash
docker compose up
```
Go to http://localhost:8000/ and enter airbyte/password as username and password.

# secure instance
on ubuntu 22.04:
```bash
wget https://github.com/airbytehq/abctl/releases/download/v0.16.0/abctl-v0.16.0-linux-amd64.tar.gz
tar -xvzf abctl-v0.16.0-linux-amd64.tar.gz
mv abctl-v0.16.0-linux-amd64/abctl .
chmod +x abctl
./abctl  version
# get the username and password
./abctl local credentials
```
Choose an email as username and enter the random password that you received in terminal. Since the password is random this is a secure airbyte instance. 