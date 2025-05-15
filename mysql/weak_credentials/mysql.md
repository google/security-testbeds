# MYSQL
# Setup

1. Create docker image with this command: `docker run --name mysql-name -e MYSQL_USER=username -e MYSQL_PASSWORD=password -e MYSQL_ROOT_PASSWORD=rootpassword -d mysql:tag`

2. Verify MySQL is working as intended: `docker run -it --rm mysql mysql -h ip-addr -u username -p`