# Axis2 Weak Credentials Setup

1. On axis2_unsecured folder there is a Dockerfile that creates an instance with default Axis2 default credentials

2. On axis2_secured folder there is a Dockerfile that creates an instance with a different password

3. UNSECURED: Run the docker build: `cd axis2_unsecured && docker build . -t axis2_unsecured && docker run -d -p 8080:8080 --name axis2_unsecured axis2_unsecured && cd ..`

4. Connect to it locally by going to `http://localhost:8080/axis2/axis2-admin/welcome` and using default credentials `admin` and `axis2`

5. SECURED: Run the docker build: `cd axis2_secured && docker build . -t axis2_secured && docker run -d -p 8081:8080 --name axis2_secured axis2_secured && cd ..`

6. Connect to it locally by going to `http://localhost:8080/axis2/axis2-admin/welcome` and using default credentials `admin` and `axis2`

7. CLEAN-UP: Run the command `docker stop axis2_unsecured && docker rm axis2_unsecured && docker stop axis2_secured && docker rm axis2_secured`
