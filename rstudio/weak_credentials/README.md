# RStudio Server

## Setup

1. `docker build -t rstudio .`
2. `docker run --rm -p 8000:8787 rstudio`

Notice that we are mapping port 8787 on 8000 to make it detectable by nmap during the scanning. Also notice that we have set the default credentials in the Dockerfile
