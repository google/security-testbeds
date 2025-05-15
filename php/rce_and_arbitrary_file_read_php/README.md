# A simple PHP webapp vulnerable to RCE and Arbitrary File Read

 This webapp can be used for testing RCE and arbitrary file read exploitation. It was originally created to test 
 blind RCE payload (linux_curl_trace_read).

# Setup

1. Build with:

   `docker build --platform linux/amd64 -t rce-read .`
   
2. Run with:
   
   `docker run --rm  -p 8888:80 --name rce-read --platform linux/amd64 rce-read`

3. Open the webapp at:

   `http://localhost:8888/`
