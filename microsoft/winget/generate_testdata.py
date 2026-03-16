#!/usr/bin/env python3
"""
Generate sample WinGet SQLite databases for testing OSV-Scalibr WinGet extractor.

This script creates SQLite databases with the same schema and sample data
used by the WinGet extractor tests.
"""

import sqlite3
import os
import sys


def create_winget_database(db_path, packages):
    """Create a WinGet SQLite database with the given packages."""

    # Remove existing database if it exists
    if os.path.exists(db_path):
        os.remove(db_path)

    # Ensure directory exists
    os.makedirs(os.path.dirname(db_path), exist_ok=True)

    conn = sqlite3.connect(db_path)
    cursor = conn.cursor()

    # Create schema (based on winget_test.go)
    schema = """
    CREATE TABLE [metadata](
        [name] TEXT PRIMARY KEY NOT NULL,
        [value] TEXT NOT NULL);
    CREATE TABLE [ids](rowid INTEGER PRIMARY KEY, [id] TEXT NOT NULL);
    CREATE UNIQUE INDEX [ids_pkindex] ON [ids]([id]);
    CREATE TABLE [names](rowid INTEGER PRIMARY KEY, [name] TEXT NOT NULL);
    CREATE UNIQUE INDEX [names_pkindex] ON [names]([name]);
    CREATE TABLE [monikers](rowid INTEGER PRIMARY KEY, [moniker] TEXT NOT NULL);
    CREATE UNIQUE INDEX [monikers_pkindex] ON [monikers]([moniker]);
    CREATE TABLE [versions](rowid INTEGER PRIMARY KEY, [version] TEXT NOT NULL);
    CREATE UNIQUE INDEX [versions_pkindex] ON [versions]([version]);
    CREATE TABLE [channels](rowid INTEGER PRIMARY KEY, [channel] TEXT NOT NULL);
    CREATE UNIQUE INDEX [channels_pkindex] ON [channels]([channel]);
    CREATE TABLE [manifest](rowid INTEGER PRIMARY KEY, [id] INT64 NOT NULL, [name] INT64 NOT NULL, [moniker] INT64 NOT NULL, [version] INT64 NOT NULL, [channel] INT64 NOT NULL, [pathpart] INT64 NOT NULL, hash BLOB, arp_min_version INT64, arp_max_version INT64);
    CREATE TABLE [tags](rowid INTEGER PRIMARY KEY, [tag] TEXT NOT NULL);
    CREATE UNIQUE INDEX [tags_pkindex] ON [tags]([tag]);
    CREATE TABLE [tags_map]([manifest] INT64 NOT NULL, [tag] INT64 NOT NULL, PRIMARY KEY([tag], [manifest])) WITHOUT ROWID;
    CREATE TABLE [commands](rowid INTEGER PRIMARY KEY, [command] TEXT NOT NULL);
    CREATE UNIQUE INDEX [commands_pkindex] ON [commands]([command]);
    CREATE TABLE [commands_map]([manifest] INT64 NOT NULL, [command] INT64 NOT NULL, PRIMARY KEY([command], [manifest])) WITHOUT ROWID;
    """

    cursor.executescript(schema)

    # Keep track of existing lookup table entries to avoid duplicates
    id_ids = {}
    name_ids = {}
    moniker_ids = {}
    version_ids = {}
    channel_ids = {}
    tag_ids = {}
    command_ids = {}

    next_id_id = 1
    next_name_id = 1
    next_moniker_id = 1
    next_version_id = 1
    next_channel_id = 1
    next_tag_id = 1
    next_command_id = 1

    # Insert test data
    for i, pkg in enumerate(packages, 1):
        manifest_id = i

        # Insert or get IDs for lookup table values
        if pkg["id"] not in id_ids:
            id_ids[pkg["id"]] = next_id_id
            cursor.execute(
                "INSERT INTO ids (rowid, id) VALUES (?, ?)", (next_id_id, pkg["id"])
            )
            next_id_id += 1

        if pkg["name"] not in name_ids:
            name_ids[pkg["name"]] = next_name_id
            cursor.execute(
                "INSERT INTO names (rowid, name) VALUES (?, ?)",
                (next_name_id, pkg["name"]),
            )
            next_name_id += 1

        if pkg["moniker"] not in moniker_ids:
            moniker_ids[pkg["moniker"]] = next_moniker_id
            cursor.execute(
                "INSERT INTO monikers (rowid, moniker) VALUES (?, ?)",
                (next_moniker_id, pkg["moniker"]),
            )
            next_moniker_id += 1

        if pkg["version"] not in version_ids:
            version_ids[pkg["version"]] = next_version_id
            cursor.execute(
                "INSERT INTO versions (rowid, version) VALUES (?, ?)",
                (next_version_id, pkg["version"]),
            )
            next_version_id += 1

        if pkg["channel"] not in channel_ids:
            channel_ids[pkg["channel"]] = next_channel_id
            cursor.execute(
                "INSERT INTO channels (rowid, channel) VALUES (?, ?)",
                (next_channel_id, pkg["channel"]),
            )
            next_channel_id += 1

        # Insert manifest using the lookup IDs
        cursor.execute(
            "INSERT INTO manifest (rowid, id, name, moniker, version, channel, pathpart) VALUES (?, ?, ?, ?, ?, ?, ?)",
            (
                manifest_id,
                id_ids[pkg["id"]],
                name_ids[pkg["name"]],
                moniker_ids[pkg["moniker"]],
                version_ids[pkg["version"]],
                channel_ids[pkg["channel"]],
                -1,
            ),
        )

        # Insert tags
        for tag in pkg.get("tags", []):
            if tag not in tag_ids:
                tag_ids[tag] = next_tag_id
                cursor.execute(
                    "INSERT INTO tags (rowid, tag) VALUES (?, ?)", (next_tag_id, tag)
                )
                next_tag_id += 1
            cursor.execute(
                "INSERT INTO tags_map (manifest, tag) VALUES (?, ?)",
                (manifest_id, tag_ids[tag]),
            )

        # Insert commands
        for command in pkg.get("commands", []):
            if command not in command_ids:
                command_ids[command] = next_command_id
                cursor.execute(
                    "INSERT INTO commands (rowid, command) VALUES (?, ?)",
                    (next_command_id, command),
                )
                next_command_id += 1
            cursor.execute(
                "INSERT INTO commands_map (manifest, command) VALUES (?, ?)",
                (manifest_id, command_ids[command]),
            )

    conn.commit()
    conn.close()
    print(f"Created database: {db_path}")


def main():
    base_dir = os.path.dirname(os.path.abspath(__file__))

    # Sample packages for user installed database
    user_packages = [
        {
            "id": "Git.Git",
            "name": "Git",
            "version": "2.50.1",
            "moniker": "git",
            "channel": "",
            "tags": ["git", "vcs", "developer-tools"],
            "commands": ["git"],
        },
        {
            "id": "Microsoft.VisualStudioCode",
            "name": "Microsoft Visual Studio Code",
            "version": "1.103.1",
            "moniker": "vscode",
            "channel": "stable",
            "tags": ["developer-tools", "editor", "ide"],
            "commands": ["code"],
        },
        {
            "id": "Google.Chrome",
            "name": "Google Chrome",
            "version": "120.0.6099.109",
            "moniker": "chrome",
            "channel": "stable",
            "tags": ["browser", "web"],
            "commands": ["chrome"],
        },
    ]

    # Sample packages for Store Edge database
    store_packages = [
        {
            "id": "Microsoft.PowerShell",
            "name": "PowerShell",
            "version": "7.4.1",
            "moniker": "powershell",
            "channel": "stable",
            "tags": ["shell", "terminal", "microsoft"],
            "commands": ["pwsh", "powershell"],
        },
        {
            "id": "Mozilla.Firefox",
            "name": "Mozilla Firefox",
            "version": "121.0.1",
            "moniker": "firefox",
            "channel": "release",
            "tags": ["browser", "web", "mozilla"],
            "commands": ["firefox"],
        },
    ]

    # Sample packages for system repository
    system_packages = [
        {
            "id": "Microsoft.WindowsTerminal",
            "name": "Windows Terminal",
            "version": "1.18.3181.0",
            "moniker": "wt",
            "channel": "stable",
            "tags": ["terminal", "microsoft", "system"],
            "commands": ["wt"],
        },
        {
            "id": "Microsoft.VCRedist.2015+.x64",
            "name": "Microsoft Visual C++ 2015-2022 Redistributable (x64)",
            "version": "14.38.33135.0",
            "moniker": "vcredist2022x64",
            "channel": "",
            "tags": ["runtime", "microsoft", "system"],
            "commands": [],
        },
    ]

    # Create databases
    user_db_path = os.path.join(
        base_dir,
        "testdata/Users/test/AppData/Local/Packages/Microsoft.DesktopAppInstaller_8wekyb3d8bbwe/LocalState/Microsoft.Winget.Source_8wekyb3d8bbwe/installed.db",
    )
    create_winget_database(user_db_path, user_packages)

    store_db_path = os.path.join(
        base_dir,
        "testdata/Users/test/AppData/Local/Packages/Microsoft.DesktopAppInstaller_8wekyb3d8bbwe/LocalState/StoreEdgeFD/installed.db",
    )
    create_winget_database(store_db_path, store_packages)

    system_db_path = os.path.join(
        base_dir,
        "testdata/ProgramData/Microsoft/Windows/AppRepository/StateRepository-Machine.srd",
    )
    create_winget_database(system_db_path, system_packages)

    print("All test databases created successfully!")


if __name__ == "__main__":
    main()
