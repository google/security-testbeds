import subprocess
from flask import Flask, request, Response
import requests
import sys


token = str(sys.argv[1])
app = Flask(__name__)

# Define the new destination base URL
new_destination = 'http://'+str(sys.argv[2])


@app.route('/', defaults={'path': ''}, methods=['GET', 'POST', 'PUT', 'DELETE'])
@app.route('/<path:path>', methods=['GET', 'POST', 'PUT', 'DELETE'])
def proxy(path):
    # Construct the new URL
    new_url = f"{new_destination}/{path}"

    # Get the method of the request (GET, POST, etc.)
    method = request.method

    # Get the headers from the incoming request and add the custom header
    headers = {key: value for key, value in request.headers if key != 'Host'}
    headers["X-SLURM-USER-TOKEN"] = token.strip().removeprefix("SLURM_JWT=")
    headers["X-SLURM-USER-NAME"] = "root"

    # Handle different methods
    if method == 'GET':
        response = requests.get(new_url, headers=headers, params=request.args)
    elif method == 'POST':
        response = requests.post(new_url, headers=headers, data=request.data)
    elif method == 'PUT':
        response = requests.put(new_url, headers=headers, data=request.data)
    elif method == 'DELETE':
        response = requests.delete(new_url, headers=headers, data=request.data)
    else:
        response = Response("Method Not Allowed", status=405)

    # Create a response object and copy the response from the new URL
    proxied_response = Response(response.content, status=response.status_code)
    for key, value in response.headers.items():
        if key.lower() != 'content-encoding':  # Skip content encoding headers
            proxied_response.headers[key] = value

    return proxied_response


if __name__ == '__main__':
    try:
        app.run(host="0.0.0.0",port=8082)
    except KeyboardInterrupt:
        print("\nKeyboard interrupt received, shutting down the server.")
