# Couchbase
# Setup

1. Create docker image with this command: `docker run -d --name some-couch -p 8091-8097:8091-8097 -p 9123:9123 -p 11207:11207 -p 11210:11210 -p 11280:11280 -p 18091-18097:18091-18097 couchbase`

2. Connect to the db: Go to `localhost:8091` and finish set up

3. Verify Couchbase is working as intended: `curl 127.0.0.1:8091/pools --user "Administrator:example"`