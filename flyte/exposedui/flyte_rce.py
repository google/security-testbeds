import argparse
from urllib.parse import urlparse

from flytekit import ContainerTask, kwtypes, task, workflow
from flytekit.configuration import (Config, FastSerializationSettings, Image,
                                    ImageConfig, SerializationSettings)
from flytekit.extras.tasks.shell import OutputLocation, ShellTask
from flytekit.models.literals import LiteralMap
from flytekit.remote import FlyteRemote

PROJECT="flytesnacks"
DOMAIN="development"
DOCKER_IMAGE="docker.io/nginx:latest"


def get_domain_info(url):
    # Parse the URL
    parsed_url = urlparse(url)
    
    # Extract the domain and port
    domain = f"{parsed_url.hostname}:{parsed_url.port}" if parsed_url.port else parsed_url.hostname
    
    # Determine if the connection is secure
    insecure = parsed_url.scheme == "http"
    
    return domain, insecure


parser = argparse.ArgumentParser(description="Script to process URLs with a callback.")
parser.add_argument("--url", type=str, required=True, help="The URL to process.")
parser.add_argument("--callback_url", type=str, required=True, help="The callback URL to be used.")

args = parser.parse_args()
endpoint, insecure = get_domain_info(args.url)


# Create a FlyteRemote object to connect to the Flyte backend
remote = FlyteRemote(
    config=Config.for_endpoint(endpoint=endpoint,insecure=insecure),
    default_project="flytesnacks",
    default_domain="development",
)

#Create ContainerTask Task Object
container_task = ContainerTask(
    name="flyte_file_io",
    image=DOCKER_IMAGE,
    command=[
        "curl",
        args.callback_url,
        "-k"
    ],
)
default_img = Image(name="default", fqn="docker.io/nginx", tag="latest")
serialization_settings = SerializationSettings(
    project="flytesnacks",
    domain="development",
    version="v1",
    env=None,
    image_config=ImageConfig(default_image=default_img, images=[default_img]),

)
ssettings = (
    serialization_settings.new_builder()
    .with_fast_serialization_settings(FastSerializationSettings(enabled=True))
    .build()
)

# Register the shell task using the custom Docker image
flyte_task = remote.register_task(
    entity=container_task, 
    serialization_settings=ssettings,
    version="v1",  # Increment the version as needed
)

print(f"Task registered: {flyte_task.id}")
# Execute the registered shell task
execution = remote.execute(
    flyte_task,  # The registered ShellTask object
    inputs={},  # No inputs required for this task
    wait=True  # Block until execution completes
)

# Print the execution status
print(f"Task executed with execution ID: {execution.id}")
print(f"Execution status: {execution.closure.phase}")
print("Check the Callback URL logs")
