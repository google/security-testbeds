
# Common steps for both safe and unsafe zenml instances
First, install the docker on your host machine.
for running both safe and unsafe zenml instances execute `docker compose up` in this directory.

# Access to the unsafe instance
On the host machine, you can navigate to http://172.20.0.2:8080/ to access the platform.
You can now log in by using a default credential, username is `default`, and leave the password field empty.

# Access to the safe instance
On the host machine, you can navigate to http://172.20.0.3:8080/ to access the platform. It will ask you to set a username and password, so no weak credentials exist in this instance.
