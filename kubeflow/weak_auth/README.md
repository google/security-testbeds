# Setup Kubeflow

On an Ubuntu 24.04 virtual machine:
```bash
bash start.sh
```
# Set default password
by default the username and password is `user@example.com:12341234`. 
if we changed the default password, we can set the default password again with help of the following script.
```bash
bash set_default_user_pass.sh
```
go to localhost:8080 and login with `user@example.com` as username and `12341234` as password.

# Set random password
```bash
bash set_random_user_pass.sh
```
go to localhost:8080 and login with `user@example.com` as username and password is `fk21455FLEPRIQ` as a secure random password.
