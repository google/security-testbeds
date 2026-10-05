# start vulnerable version
```bash
docker compose up --no-build
```

Note: depending on the version of the docker image, the port can change.

tag "simple" uses port 8081, while tag 1.20.1 uses port 8083.

Open http://127.0.0.1:8083/#/submit
