# xrdp Weak Credential Setup

## Option 1 - GCE VM

1. Create a new debian based GCE VM
2. Install graphical interface and enable xrdp. You can follow the reference at https://linuxize.com/post/how-to-install-xrdp-on-debian-10/.

```sh
 sudo apt update
 sudo apt install xfce4 xfce4-goodies xorg dbus-x11 x11-xserver-utils
 sudo apt install xrdp
 sudo systemctl status xrdp
 sudo adduser xrdp ssl-cert
 sudo systemctl restart xrdp
```

3. Enable password-base auth on the vm

```sh
   sudo vim /etc/ssh/sshd_config
   # Change `PasswordAuthentication yes`
   sudo service ssh restart
```

4. Configure a weak password to your user
``` sh
  sudo passwd <username>
```

## Option 2 - Running xrdp in Docker

Use the docker image from https://github.com/satishweb/docker-xrdp.

```sh
docker run -d -e GUEST_PASS='guest' -p 3389:3389 --name xrdp satishweb/xrdp
```
