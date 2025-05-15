# A simple PHP webapp vulnerable to Arbitrary File Write with CRON daemon

 This webapp can be used for testing arbitrary file write exploitation. It was originally created to test 
 file write to RCE via crontab payload (linux_root_crontab)

# Setup

1. Build with:

   `docker build --platform linux/amd64 -t phpd-arbitrary-file-write`
   
2. Run with:
   
   `docker run --rm  -p 8888:80 --name phpd-app --platform linux/amd64 phpd-arbitrary-file-write`

3. Open the webapp at:

   `http://localhost:8888/`
