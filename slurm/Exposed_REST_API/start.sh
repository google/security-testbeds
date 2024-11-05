export DISABLE_XDMOD=1
export NODELIST=scaleout/nodelist
export SLURM_RELEASE=slurm-24.05
git clone https://gitlab.com/SchedMD/training/docker-scale-out --depth 1
cd docker-scale-out/ || exit
# current commit that has been used for the testbed
git checkout 562e5bb92d19f0af6b3b6aee2665cf093d5b32d4
git submodule update --init --force --remote --recursive
cat << EOF >> scaleout/nodelist
node01 cluster 10.11.5.11 2001:db8:1:1::5:11
EOF
make clean && make && (
  cd ../authProxy || exit
  apt install python3-pip -y
  apt install python3-venv -y
  python3 -m venv venv
  source ./venv/bin/activate
  pip install flask requests
  python3 proxy.py "$(docker exec docker-scale-out-rest-1  scontrol token)" "$(docker inspect -f '{{range.NetworkSettings.Networks}}{{.IPAddress}}{{end}}' docker-scale-out-rest-1)"
)
