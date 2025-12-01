# Omnilab Android Test Studio

Setup Omnilab ATS following the steps reported in the official [documentation page](https://source.android.com/docs/core/tests/development/android-test-station/ats-user-guide#install-with-installer). The testbed will be setup through docker and can be managed using the CLI utility `mtt`.

## Installation steps

```sh
curl https://storage.googleapis.com/android-mtt.appspot.com/prod/install.sh | bash
```

OATS can then be run using the `mtt` cli utility. The UI will then be exposed by default on <https://localhost:8000> where a setup wizard will allow to finalize the installation.

```sh
mtt start
```

## Hardening steps

OmniLab ATS has no built-in authentication. Either block external access or use a reverse proxy with basic auth to secure it. An example of how this can be done on a linux machine with nginx is reported below:

Start the service on a different port

```sh
mtt stop
mtt start --port 8001
```

Install nginx and configure a basic auth password file

```sh
sudo apt install nginx apache2-utils
sudo htpasswd -c /etc/nginx/.htpasswd admin
```

Configure nginx (`/etc/nginx/sites-available/ats`):

```conf
server {
    listen 8000;
    server_name _;

    location / {
        auth_basic "OmniLab ATS";
        auth_basic_user_file /etc/nginx/.htpasswd;

        proxy_pass http://localhost:8001;
        proxy_set_header Host $host;
        proxy_set_header X-Real-IP $remote_addr;
        proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
    }
}
```

Enable and restart nginx

```sh
sudo ln -s /etc/nginx/sites-available/ats /etc/nginx/sites-enabled/
sudo nginx -t
sudo systemctl restart nginx
```

## References

- <https://source.android.com/docs/core/tests/development/android-test-station/ats-user-guide>
