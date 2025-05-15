# MongoDB
# Setup

1. Create docker image with this command: `docker run --name some-mongo -e MONGO_INITDB_ROOT_USERNAME=root -e MONGO_INITDB_ROOT_PASSWORD=example -d mongo:latest`

2. Verify Mongo is working as intended: `docker run -it --rm mongo mongosh --host ip-addr -u username`