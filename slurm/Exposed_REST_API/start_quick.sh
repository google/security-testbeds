cd start_quick || exit
docker compose up -d

cd ../authProxy || exit
apt install python3-pip
apt install python3.11-venv
python3.11 -m venv venv
source ./venv/bin/activate
pip install flask requests --break-system-packages
python3 proxy.py "$(docker exec start_quick-rest-1  scontrol token)" "$(docker inspect -f '{{range.NetworkSettings.Networks}}{{.IPAddress}}{{end}}' start_quick-rest-1)"

