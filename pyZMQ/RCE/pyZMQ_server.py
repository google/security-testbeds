import zmq as zmq

# Create a ZeroMQ context
context = zmq.Context()

# Create a REP (Reply) socket
socket = context.socket(zmq.REP)

# Bind the socket to a TCP address
socket.bind("tcp://*:5555")  # Listen on port 5555

print("Server is listening on tcp://*:5555...")

while True:
    try:
        # Receive a Python object
        received_obj = socket.recv_pyobj()
        print(f"Received object: {received_obj}")

        # Send a response back to the client
        response = f"Server received: {received_obj}"
        socket.send_pyobj(response)

    except KeyboardInterrupt:
        print("Server shutting down...")
        break

# Clean up
socket.close()
context.term()