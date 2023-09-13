# SMB
# Setup

1. Create docker image with this command:
    ```
    sudo docker run -it -p 139:139 -p 445:445 -d dperson/samba -p \
    -u "example1;badpass" \
    -u "example2;badpass" \
    -s "public;/share;yes;no;no" \
    -s "users;/srv;no;no;no;example1,example2" \
    -s "example1 private share;/example1;no;no;no;example1" \
    -s "example2 private share;/example2;no;no;no;example2" \
    -g "restrict anonymous=2" \
    -g "map to guest = Bad User" -S

    ```

2. Run and verify that it is up and running: `smbclient -L ip-addr -U user`

3. Verify that it is working properly: `smbclient //ip-addr/IPC$ -U user`