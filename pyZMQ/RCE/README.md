# PyZMQ Server Unsafe Pickle Deserialization
Please note that _there is currently no safe version of the software_. The current version at this time is 26.4.0.

## Setup Vulnerable version

1. **Run the Server**:
   ```sh
   docker compose run --rm pyzmq_vulnerable_rpc_server 
   ```
2. **Run the Client**:

   Execute the `pyZMQ_exploit.py` script to send a command to the server.  
   ```sh
   docker compose run --rm exploit command_to_execute
   ```
   now you can watch the output of the command in the server container output(previous step).
