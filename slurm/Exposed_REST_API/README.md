# vulnerable setup
on ubuntu 24.04 install docker and then:
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
  "storage-driver": "overlay2"
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
apt install python3-pip
apt install python3.12-venv
python3 -m venv venv 
source ./venv/bin/activate
pip install flask requests
# If docker compose has not spun up yet, the following will give you an error
python3 proxy.py
# in another shell
curl -k -vvvv 'http://127.0.0.1:8080/openapi/v3'
```
this is a smaller version of this docker compose setup: https://gitlab.com/SchedMD/training/docker-scale-out

for testing the safe setup just send the request directly to the REST API server:
```
curl -k -vvvv 'http://10.11.1.6:6820/openapi/v3'
# TTP/1.1 401 UNAUTHORIZED
```
