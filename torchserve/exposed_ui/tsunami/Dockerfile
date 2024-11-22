# Start from the existing Tsunami image
FROM tsunami

RUN apt update && apt upgrade -y && apt install -y \
    python3 nmap ncat inetutils-ping curl wget less jq vim zip jq

# Copy custom plugins into the container
COPY custom_plugins/ /usr/tsunami/custom_plugins

# Copy a custom entrypoint script into the container
COPY tsunami.sh /tsunami.sh

# Set the custom entrypoint script as the entrypoint
ENTRYPOINT ["/tsunami.sh"]
