# Grafana

# Note
The `Dockerfile.Grafana` contains the following customisation:
- the admin user is created with the credential `admin:qwertyuiop` instead of the usual `admin:admin`
- grafana is started with disabled brute force login protection (`GF_SECURITY_DISABLE_BRUTE_FORCE_LOGIN_PROTECTION=TRUE`) - by default it is enable

# Setup
1. Ensure the files `runAndBuildGraphana.sh` and `Dockerfile.Grafana` are in the same folder

2. Create docker images with this command: `chmod +x runAndBuildGraphana.sh && ./runAndBuildGraphana.sh`

3. Connect to http://localhost:8873/ via browser

4. Verify that grafana is running correctly by logging in with credential `admin:qwertyuiop`
