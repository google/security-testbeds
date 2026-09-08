FROM ubuntu:22.04

RUN apt-get update

RUN mkdir -p /testdata

# Set working directory
WORKDIR /testdata

# Copy valid apk file into the container
COPY split_CronetDynamite_installtime.apk /split_CronetDynamite_installtime.apk

CMD ["/bin/bash"]
