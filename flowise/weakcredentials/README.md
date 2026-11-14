# Flowise Weak Credentials
This directory contains the deployment config for Flowise instances protected by either strong or weak credentials.

## How to Check for Weak Credentials?
The following curl command allows to authenticate with the user "admin@localhost.lan" and the password "Dragon1!"
```sh
curl -X POST http://127.0.0.1:3000/api/v1/auth/login \
	-H "Content-Type: application/json" \
	-d '{"email":"admin@localhost.lan","password":"Dragon1!"}'
```

If the right user and password are provided, the server returns a `200 OK` HTTP status code with a body looking like:
```json
{"id":"5b658172-fab9-478c-b6a3-bcf19a4ec1b3","email":"admin@localhost.lan","name":"Admin","roleId":"6ec75515-d825-14ff-84a6-92e55c3f8991","activeOrganizationId":"4ba1ad86-6cbb-4679-a86c-8b011dfc5e10","activeOrganizationSubscriptionId":null,"activeOrganizationCustomerId":null,"activeOrganizationProductId":"","isOrganizationAdmin":true,"activeWorkspaceId":"bf8816b0-9c49-4095-a646-0f26076c351e","activeWorkspace":"Default Workspace","assignedWorkspaces":[{"id":"bf8816b0-9c49-4095-a646-0f26076c351e","name":"Default Workspace","role":"owner","organizationId":"4ba1ad86-6cbb-4679-a86c-8b011dfc5e10"}],"permissions":["organization","workspace"],"features":{},"isSSO":false}
```

If the password is wrong but the user exists, the server answers with a `401 Unauthorized` error:
```json
{"statusCode":401,"success":false,"message":"Incorrect Email or Password","stack":{}}
```

If the user does not exist, the server answers with a `404 Not Found` error:
```json
{"statusCode":404,"success":false,"message":"User Not Found","stack":{}}
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
