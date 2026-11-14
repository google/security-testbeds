#!/bin/sh

/usr/local/bin/node /usr/local/bin/flowise start &

until curl -f -s "http://127.0.0.1:3000" > /dev/null; do
    echo "Server not ready yet, retrying in 5 seconds..."
    sleep 5
done

curl -X POST http://127.0.0.1:3000/api/v1/account/register \
	-H "Content-Type: application/json" \
	-d "{\"user\":{\"name\":\"Admin\",\"email\":\"${FLOWISE_EMAIL}\",\"credential\":\"${FLOWISE_PASSWD}\"}}"


echo
echo "[Flowise-Init] Flowise Set Up With Success"
sleep infinity
