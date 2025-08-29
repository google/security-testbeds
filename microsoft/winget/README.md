# OSV-Scalibr: Windows Package Manager (WinGet) Extractor

This directory contains the test Docker setup for testing OSV-Scalibr's WinGet extractor plugin. Windows Package Manager (WinGet) is Microsoft's official package manager for Windows systems that stores its database files in SQLite format at specific system locations.

## Overview

The WinGet extractor analyzes installed Windows packages by reading SQLite database files created by the Windows Package Manager. This testbed simulates the Windows file system structure and provides sample WinGet databases for testing purposes.

## WinGet Database Locations

The WinGet extractor looks for databases at these Windows paths:

1. **User-installed packages**: `%LOCALAPPDATA%/Packages/Microsoft.DesktopAppInstaller_8wekyb3d8bbwe/LocalState/Microsoft.Winget.Source_8wekyb3d8bbwe/installed.db`
2. **Store Edge packages**: `%LOCALAPPDATA%/Packages/Microsoft.DesktopAppInstaller_8wekyb3d8bbwe/LocalState/StoreEdgeFD/installed.db`  
3. **System-wide repository**: `%PROGRAMDATA%/Microsoft/Windows/AppRepository/StateRepository-Machine.srd`

## Test Database Contents

This testbed includes three sample databases with the following packages:

### User Installed Database
- **Git.Git** v2.50.1 - Git version control system
- **Microsoft.VisualStudioCode** v1.103.1 - Visual Studio Code editor
- **Google.Chrome** v120.0.6099.109 - Google Chrome browser

### Store Edge Database  
- **Microsoft.PowerShell** v7.4.1 - PowerShell terminal
- **Mozilla.Firefox** v121.0.1 - Mozilla Firefox browser

### System Repository Database
- **Microsoft.WindowsTerminal** v1.18.3181.0 - Windows Terminal
- **Microsoft.VCRedist.2015+.x64** v14.38.33135.0 - Visual C++ Redistributable

## Setup Instructions

### Build the Docker Image

```bash
cd security-testbeds/microsoft/winget
docker build -t winget-test .
```

### Run the Container

```bash
docker run -it --rm -v $(pwd):/app winget-test
```

This will:
- Start an interactive bash session
- Mount the current directory as `/app` inside the container
- Allow you to place the `scalibr` binary in `/app` and run tests

### Running OSV-Scalibr

1. Build or copy the `scalibr` binary to the current directory
2. Run the container as shown above
3. Inside the container, run scalibr with the WinGet extractor:

```bash
# Extract from all WinGet databases
./scalibr --extractors=os/winget --result=winget_output.json

# Or target specific paths
./scalibr --extractors=os/winget --result=winget_output.json --paths=/Users/test/AppData/Local,/ProgramData/Microsoft
```

### Verify Database Contents

You can inspect the test databases using sqlite3:

```bash
# Inside the container
sqlite3 /Users/test/AppData/Local/Packages/Microsoft.DesktopAppInstaller_8wekyb3d8bbwe/LocalState/Microsoft.Winget.Source_8wekyb3d8bbwe/installed.db

# List tables
.tables

# Query packages
SELECT i.id, n.name, v.version FROM manifest m
JOIN ids i ON m.id = i.rowid  
JOIN names n ON m.name = n.rowid
JOIN versions v ON m.version = v.rowid;
```

## Regenerating Test Data

The `generate_testdata.py` script can be used to recreate the test databases with different package sets:

```bash
python3 generate_testdata.py
```

Edit the script to add new packages or modify existing ones before regenerating the databases.

## Important Note: Windows-Only Extractor

The WinGet extractor is designed to run **only on Windows systems** due to OS-specific requirements. When running in this Linux Docker container, you will see:

```bash
./scalibr --plugins=os/winget --result=output.textproto
# Output: plugin os/winget can't be enabled: needs to run on a different OS than that of the scan environment
```

This is **expected behavior** and indicates the testbed is set up correctly.

## Purpose of This Testbed

This Docker setup serves several purposes:

1. **Validation**: Provides a standardized environment to test WinGet database parsing logic
2. **Development**: Allows developers to work with realistic WinGet database structures without Windows
3. **CI/CD**: Can be used in automated testing pipelines to verify database schema compatibility
4. **Reference**: Documents the expected WinGet database structure and file locations

## Expected Output (on Windows)

When running scalibr successfully on a Windows system, you should see extracted package information for 7 total packages across the three databases, including package names, versions, and metadata like monikers, channels, tags, and commands.

## Troubleshooting

- **"needs to run on a different OS"**: This is expected when running on non-Windows systems
- **Database errors**: Verify the database files exist and have proper SQLite schema using the inspection commands above
- **Permission issues**: Make sure the scalibr binary has execute permissions: `chmod +x scalibr`
- **No packages found on Windows**: Ensure the WinGet extractor is enabled with `--plugins=os/winget`