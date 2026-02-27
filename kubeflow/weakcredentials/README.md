# Setup Kubeflow

Please make sure you have deleted the existing minikube cluster: `minikube delete --all` this is to avoid any conflicts
with the new cluster.

# Prerequisites

1. Ubuntu 24.04 machine with 8GB RAM and 16 CPUs.
2. A `docker.com` account.

```bash
bash start.sh
```

# Set default password

by default, the username and password is `user@example.com:12341234`.
if we change the default password, we can set the default password again with the help of the following script.

```bash
bash set_default_user_pass.sh
```

go to localhost:8080 and login with `user@example.com` as username and `12341234` as password.

# Set random password

```bash
bash set_random_user_pass.sh
```

go to localhost:8080 and login with `user@example.com` as username and password is `fk21455FLEPRIQ` as a secure random
password.

# Troubleshooting

if during the "Build and Apply manifests for pipelines" step you faced any errors, please do `minikube delete` and run
the `start.sh` script again.