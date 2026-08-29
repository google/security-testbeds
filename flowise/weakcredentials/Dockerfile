# Tested with flowiseai/flowise:3.1.0 Docker Image
ARG FLOWISE_VERSION=3.1.0
FROM flowiseai/flowise:${FLOWISE_VERSION}

# Arguments
ARG FLOWISE_EMAIL=admin@localhost.lan
ARG FLOWISE_PASSWD=Dragon1!

# Flowise Directory
ENV FLOWISE_DIR=/opt/flowise
WORKDIR ${FLOWISE_DIR}

# Upload init scripts
ENV FLOWISE_SCRIPT_INIT=flowise-init.sh
COPY ${FLOWISE_SCRIPT_INIT} ${FLOWISE_DIR}
RUN chmod +x ${FLOWISE_DIR}/${FLOWISE_SCRIPT_INIT}

# Exposing Flowise port
EXPOSE 3000

# REMOVE-AFTER
RUN apk add --no-cache nano

# Automating the installation process
ENV FLOWISE_EMAIL=${FLOWISE_EMAIL}
ENV FLOWISE_PASSWD=${FLOWISE_PASSWD}

ENTRYPOINT ["/bin/sh", "-c", "${FLOWISE_DIR}/${FLOWISE_SCRIPT_INIT}"]
