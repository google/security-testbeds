# HTTP
# Setup
1. Create docker images with this command:
    ```
    docker run -d --name web dockercloud/hello-world
    docker run -d -p 80:80 --link web:web --name auth beevelop/nginx-basic-auth
    ```
2. Verify HTTP is working correctly by doing this command: `curl localhost:80` (add -u foo:bar to test authentication)
