# Use Ubuntu 22.04 base
FROM ubuntu:22.04

# Install bash explicitly (Ubuntu images usually have it, but to be safe)
RUN apt-get update && apt-get install -y bash gcc make perl

# Configure CPAN
RUN echo "yes" > CPAN

# Install cpan module dependency from the following recommendation: https://www.cpan.org/modules/INSTALL.html
RUN cpan App::cpanminus

# Install some CPAN modules along with their dependencies
RUN cpanm JSON LWP::UserAgent Try::Tiny Class::Data::Inheritable@0.08

# App for putting scalibr binary inside the container
RUN mkdir -p /app

# Set working directory (optional)
WORKDIR /app

# Default command: start bash so the container stays alive interactively
CMD ["/bin/bash"]
