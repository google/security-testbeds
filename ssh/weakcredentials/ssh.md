# SSH
# Setup

1. Create a docker image from the Dockerfile in this directory by running: `docker build -t myssh:latest .`
2.  Start the ssh server by running: `docker run -p 8222:22 myssh:latest`
3. Verify ssh is working by doing: `ssh user@ip`
