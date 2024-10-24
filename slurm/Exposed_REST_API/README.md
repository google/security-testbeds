# vulnerable setup
note that this is a smaller version of this docker compose setup: https://gitlab.com/SchedMD/training/docker-scale-out

## configure the OS 
on ubuntu 24.04 install docker and then:
```
sed -e 's@^GRUB_CMDLINE_LINUX=@#GRUB_CMDLINE_LINUX=@' -i /etc/default/grub
echo 'GRUB_CMDLINE_LINUX="systemd.unified_cgroup_hierarchy=1 systemd.legacy_systemd_cgroup_controller=0 cgroup_no_v1=all"' >> /etc/default/grub
update-grub
```
reboot the OS.
Validate the OS doesn't contain hybrid cgroup versions.
```
reboot
# Verify kernel has correct command line options:
grep -o -e systemd.unified_cgroup_hierarchy=. -e systemd.legacy_systemd_cgroup_controller=. /proc/cmdline
# systemd.unified_cgroup_hierarchy=1
# systemd.legacy_systemd_cgroup_controller=0
```
ref: https://slurm.schedmd.com/faq.html#cgroupv2

## configure docker
```
cat << EOFF >> /etc/docker/daemon.json
{
  "exec-opts": [
    "native.cgroupdriver=systemd"
  ],
  "features": {
    "buildkit": true
  },
  "experimental": true,
  "cgroup-parent": "docker.slice",
  "default-cgroupns-mode": "host",
  "storage-driver": "overlay2",
  "experimental": true,
  "ip6tables": true

}
EOFF

cat << EOFF >> /etc/systemd/system/docker.slice
[Unit]
Description=docker slice
Before=slices.target
[Slice]
CPUAccounting=true
MemoryAccounting=true
Delegate=yes
EOFF

mkdir /usr/lib/systemd/system/docker.service.d/
cat << EOFF >> /usr/lib/systemd/system/docker.service.d/local.conf
[Service]
LimitNOFILE=infinity
LimitNPROC=infinity
LimitCORE=infinity
TasksMax=infinity
Delegate=yes
EOFF

docker compose up -d
# please wait
```

## setup auth proxy
```
apt install python3-pip
apt install python3.12-venv
python3 -m venv venv 
source ./venv/bin/activate
pip install flask requests
# If docker compose has not spun up yet, the following will give you an error
python3 proxy.py
# in another shell
curl -k -vvvv 'http://127.0.0.1:8080/openapi/v3' 
# or with callback
curl -X POST "http://127.0.0.1:8080/slurm/v0.0.39/job/submit" -H "Content-Type: application/json" -d @rest_api_test.json
```
open https://webhook.site/#!/view/d5228066-c22b-4b1f-9863-afeb2765dbc2/cef28670-d825-4309-858b-02f5d9eeae85/1 to see the callback logs.

# secure setup

for testing the safe setup just send the request directly to the REST API server:
```
curl -k -vvvv 'http://10.11.1.6:6820/openapi/v3'
# HTTP/1.1 401 UNAUTHORIZED
```

