
# common steps for both safe and unsafe zenml instances
Install the docker on your host machine. 
Run `docker compose up` in this directory.

# access to the unsafe instance
On the host machine you can navigate to http://172.20.0.2:8080/ to access the platform.
You can now login by using the default credentials, which are default for the username and an empty password.

# access to the safe instance
On the host machine you can navigate to http://172.20.0.3:8080/ to access the platform.
After setup a zenml dashboard with docker it will ask you to set a password, so no weak credentials exist with this setup.
