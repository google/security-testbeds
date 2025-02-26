# PyZMQ Server Unsafe Pickle Deserialization

## Project Structure

- `setupEnv.sh`: A shell script to set up the Python virtual environment and install the required dependencies.
- `RunZmqServer.sh`: A shell script to activate the virtual environment and run the ZeroMQ server.
- `pyZMQ_server.py`: The ZeroMQ server implementation that listens on port 5555 and deserializes received Python objects.
- `pyZMQ_exploit.py`: The ZeroMQ client implementation that sends a user-provided command to the server for execution.

## Setup
The Setup should work on apt-get based Linux distros.

1. **Install Dependencies**:

   Execute the `setupEnv.sh` script to set up the virtual environment and install the required packages.
   ```sh
   ./setupEnv.sh
   ```
2. **Run the Server**:

   Execute the `RunZmqServer.sh` script to start the ZeroMQ server.
   ```sh
   ./RunZmqServer.sh
   ```
3. **Run the Client**:

   Execute the `pyZMQ_exploit.py` script to send a command to the server.  
   ```sh
   ./RunZmqExploit.sh
   ```
   When prompted, enter the command you want to execute on the server. 

