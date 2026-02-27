# Jenkins
# Setup
1: Create docker images with this command: `docker run -p 8080:8080 -p 50000:50000 --restart=on-failure jenkins/jenkins:lts-jdk11`

2: Verify docker is up with this command and check ports: `docker ps`

3: Connect to it locally by going to localhost:8080

4: Configure it using the setup client. During the docker boot up it will print a secret password, copy and paste it into the client to proceed.

5: Verify to see if working properly: Log in by visiting localhost:8080 and using root credentials
