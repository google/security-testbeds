# vulnerable setup
note that this is a smaller version of this docker compose setup: https://gitlab.com/SchedMD/training/docker-scale-out

## configure the OS 
on `ubuntu 24.04` desktop or server, [install docker](https://docs.docker.com/engine/install/ubuntu/) and then:
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
mkdir /etc/docker/
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

```
reboot the OS.

## setup slurm server
```
bash start.sh
```

## run a sample job
```bash
curl -k -vvvv 'http://127.0.0.1:8082/openapi/v3' 
curl -X POST "http://127.0.0.1:8082/slurm/v0.0.39/job/submit" -H "Content-Type: application/json" -d @rest_api_test.json
```
open https://webhook.site/#!/view/7c925655-38c0-461a-b37d-f7aa05f747e4 to see the callback logs.

# secure setup
for testing the safe setup just send the request directly to the REST API server:
```
curl -k -vvvv 'http://10.11.1.6:6820/openapi/v3'
# HTTP/1.1 401 UNAUTHORIZED
```

