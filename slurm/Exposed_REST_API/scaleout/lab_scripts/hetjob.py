#!/bin/env python3
import time
import os
import openapi_client
from openapi_client.rest import ApiException
from pprint import pprint
# Defining the host is optional and defaults to http://localhost/slurm/v0.0.37
# See configuration.py for a list of all supported configuration parameters.
configuration = openapi_client.Configuration(
    host = "http://rest/",
    api_key = {
        "X-SLURM-USER-NAME": os.environ['LOGNAME'],
        "X-SLURM-USER-TOKEN": os.environ['SLURM_JWT']
    }
)
from openapi_client.models import V0037JobSubmission as jobSubmission
from openapi_client.models import V0037JobProperties as jobProperties
from openapi_client.api import SlurmApi as slurm
# Create an instance of the API class
s = slurm(openapi_client.ApiClient(configuration))
env = {
"PATH":"/usr/local/bin:/bin:/usr/bin/:/usr/local/bin/",
"LD_LIBRARY_PATH":"/usr/local/lib64:/usr/local/lib/:/lib/:/lib64/:/usr/local/lib",
"SHELL": "/bin/bash"
}
script = "#!/bin/sh\nsrun uptime"
job = jobSubmission(script=script)
job.jobs = [
jobProperties(
    environment=env,
    current_working_directory="/tmp",
    nodes=[2,3],
),
jobProperties(
    environment=env,
    current_working_directory="/tmp",
    nodes=[2,4],
),
jobProperties(
    environment=env,
    current_working_directory="/tmp",
    nodes=[2,5],
),
]
try:
        njob = s.slurmctld_submit_job(job)
        pprint(njob)
except ApiException as e:
        print("Exception when calling: %s\n" % e)

