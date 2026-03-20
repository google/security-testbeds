# Flowise Weak Credentials
This directory contains the deployment config for Flowise instances protected by either strong or weak credentials.

## How to Check for Weak Credentials?
The following curl command allows to authenticate with the user "admin@domain.fr" and the password "Password1!"
```sh
curl -X POST http://127.0.0.1:3000/api/v1/auth/login \
	-H "Content-Type: application/json" \
	-d '{"email":"admin@domain.fr","password":"Password1!"}'
```

If the right user and password are provided, the server returns a `200 OK` HTTP status code with a body looking like:
```sh
{"id":"7881f7e9-e906-4bc3-8564-5dbf454315c9","email":"admin@domain.fr","name":"Admin","roleId":"e5ebdf3f-bac9-1af5-89a7-39a6f3e890ab","activeOrganizationId":"ceaab61e-9166-40b5-909e-40a62149e29f","activeOrganizationSubscriptionId":null,"activeOrganizationCustomerId":null,"activeOrganizationProductId":"","isOrganizationAdmin":true,"activeWorkspaceId":"45f677ee-5be5-4297-87c7-fc036433cbb9","activeWorkspace":"Default Workspace","assignedWorkspaces":[{"id":"45f677ee-5be5-4297-87c7-fc036433cbb9","name":"Default Workspace","role":"owner","organizationId":"ceaab61e-9166-40b5-909e-40a62149e29f"}],"permissions":["organization","workspace"],"features":{},"isSSO":false}
```

## Setup with Weak Credentials
To build and start an instance with weak credentials:
```sh
docker build -t flowise:weak .
docker run -d -p 3000:3000 --name flowise -it flowise:weak
```
Running `docker logs flowise` shows the execution logs of this docker instance.
The log entry `[Flowise-Init] Flowise Set Up With Success` shows that Flowise has been successfully started and set up. It can then be accessed at http://127.0.0.1:3000.

## Setup with Strong Credentials
To build and start an instance with strong credentials:
```sh
docker build --build-arg FLOWISE_PASSWD=Ao7xGz378CzKxh7zZbOsFj10w. -t flowise:strong .
docker run -d -p 3000:3000 --name flowise -it flowise:strong
```

## Manual Installation Steps
By default, the script `flowise-init.sh` is executed and automates the following installation steps :
- Wait that Flowise starts
- Connect to http://127.0.0.1:3000
- You are redirected to http://127.0.0.1:3000/organization-setup
- Fulfill the form to create the admin account (Administrator Name + Administrator Email + Password + Confirm Password), then click on "Sign Up"
