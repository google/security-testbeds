FROM ubuntu:22.04

RUN apt-get update

RUN mkdir -p /testdata

# Set working directory
WORKDIR /testdata

# Copy valid project.assets.json file into the container
COPY project.assets.json /testdata/project.assets.json

CMD ["/bin/bash"]
