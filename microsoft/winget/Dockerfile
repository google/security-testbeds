FROM ubuntu:22.04

# Install bash and sqlite3 for database verification
RUN apt-get update && apt-get install -y bash sqlite3 && rm -rf /var/lib/apt/lists/*

# Create Windows-style directory structure for WinGet databases
RUN mkdir -p /Users/test/AppData/Local/Packages/Microsoft.DesktopAppInstaller_8wekyb3d8bbwe/LocalState/Microsoft.Winget.Source_8wekyb3d8bbwe/
RUN mkdir -p /Users/test/AppData/Local/Packages/Microsoft.DesktopAppInstaller_8wekyb3d8bbwe/LocalState/StoreEdgeFD/
RUN mkdir -p /ProgramData/Microsoft/Windows/AppRepository/

# Create app directory for scalibr binary
RUN mkdir -p /app

# Copy WinGet test database files into the container
COPY testdata/ /

# Set working directory
WORKDIR /app

# Default command: start bash so the container stays alive interactively
CMD ["/bin/bash"]
