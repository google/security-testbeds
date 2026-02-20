#!/usr/bin/env python3
# Copyright 2025 Google LLC
#
# Licensed under the Apache License, Version 2.0 (the "License");
# you may not use this file except in compliance with the License.
# You may obtain a copy of the License at
#
# http://www.apache.org/licenses/LICENSE-2.0
#
# Unless required by applicable law or agreed to in writing, software
# distributed under the License is distributed on an "AS IS" BASIS,
# WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
# See the License for the specific language governing permissions and
# limitations under the License.

"""
Minimal Py4j protocol client for authenticating with DolphinScheduler's Java Gateway
and executing commands on the remote JVM.

No external dependencies required — uses only the Python standard library.
"""

import socket
import sys

AUTH_COMMAND = "A\n"
SUCCESS_PREFIX = "!y"
ERROR_PREFIX = "!x"
CALL_COMMAND = "c\n"
STATIC_PREFIX = "z:"
STRING_TYPE = "s"
REFERENCE_TYPE = "r"
END_COMMAND = "e\n"
RUNTIME_CLASS = "java.lang.Runtime"
SOCKET_TIMEOUT = 10.0


def _escape(s):
    return s.replace("\\", "\\\\").replace("\r", "\\r").replace("\n", "\\n")


def _unescape(s):
    return s.replace("\\\\", "\x00").replace("\\n", "\n").replace("\\r", "\r").replace("\x00", "\\")


class Py4jGatewayClient:
    def __init__(self, host, port, auth_token):
        self.host = host
        self.port = port
        self.auth_token = auth_token

    def _connect(self):
        """Create a socket and return (socket, rfile, wfile)."""
        sock = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
        sock.settimeout(SOCKET_TIMEOUT)
        sock.connect((self.host, self.port))
        rfile = sock.makefile("r", encoding="utf-8")
        return sock, rfile

    def _send(self, sock, data):
        sock.sendall(data.encode("utf-8"))

    def _readline(self, rfile):
        line = rfile.readline()
        if not line:
            return None
        return line.rstrip("\n")

    def _read_response(self, rfile):
        """Parse a Py4j response. Returns the object ID (for references) or value string."""
        line = self._readline(rfile)
        if line is None or line.startswith(ERROR_PREFIX):
            return None
        if line.startswith(SUCCESS_PREFIX) and len(line) > 2:
            typ = line[2]
            value = line[3:]
            if typ == REFERENCE_TYPE:
                return value
            return value if value else None
        return None

    def _read_string_response(self, rfile):
        """Parse a Py4j response expecting a string value."""
        line = self._readline(rfile)
        if line is None or line.startswith(ERROR_PREFIX):
            return None
        if line.startswith(SUCCESS_PREFIX) and len(line) > 2 and line[2] == "s":
            return _unescape(line[3:])
        return None

    def _authenticate(self, sock, rfile):
        self._send(sock, AUTH_COMMAND)
        self._send(sock, self.auth_token + "\n")
        line = self._readline(rfile)
        return line is not None and line.startswith(SUCCESS_PREFIX)

    def authenticate(self):
        """Test authentication against the gateway. Returns True on success."""
        try:
            sock, rfile = self._connect()
            try:
                return self._authenticate(sock, rfile)
            finally:
                rfile.close()
                sock.close()
        except OSError as e:
            print(f"Unable to connect to Java Gateway at {self.host}:{self.port}", file=sys.stderr)
            return False

    def run_shell_script(self, script):
        """Execute a command on the remote JVM. Returns True if successfully invoked."""
        if not script:
            return False
        try:
            sock, rfile = self._connect()
            try:
                if not self._authenticate(sock, rfile):
                    return False

                # Runtime.getRuntime()
                self._send(sock, CALL_COMMAND + STATIC_PREFIX + RUNTIME_CLASS + "\ngetRuntime\n" + END_COMMAND)
                runtime_ref = self._read_response(rfile)
                if runtime_ref is None:
                    return False

                # runtime.exec(script)
                self._send(sock, CALL_COMMAND + runtime_ref + "\nexec\n" + STRING_TYPE + _escape(script) + "\n" + END_COMMAND)
                return self._read_response(rfile) is not None
            finally:
                rfile.close()
                sock.close()
        except OSError:
            return False

    def run_shell_script_with_output(self, script):
        """Execute a command and return stdout+stderr by reading process streams."""
        if not script:
            return None
        try:
            sock, rfile = self._connect()
            try:
                if not self._authenticate(sock, rfile):
                    return None

                # Runtime.getRuntime()
                self._send(sock, CALL_COMMAND + STATIC_PREFIX + RUNTIME_CLASS + "\ngetRuntime\n" + END_COMMAND)
                runtime_ref = self._read_response(rfile)
                if runtime_ref is None:
                    return None

                # runtime.exec(script)
                self._send(sock, CALL_COMMAND + runtime_ref + "\nexec\n" + STRING_TYPE + _escape(script) + "\n" + END_COMMAND)
                process_ref = self._read_response(rfile)
                if process_ref is None:
                    return None

                result = self._read_process_output(sock, rfile, process_ref)

                # exitValue()
                self._send(sock, CALL_COMMAND + process_ref + "\nexitValue\n" + END_COMMAND)
                self._read_response(rfile)

                return result
            finally:
                rfile.close()
                sock.close()
        except OSError:
            return None

    def _read_stream_via_scanner(self, sock, rfile, stream_ref):
        """Read all content from a stream using new Scanner(stream).useDelimiter("\\A")."""
        # new Scanner(inputStream)
        self._send(sock, "i\njava.util.Scanner\n" + REFERENCE_TYPE + stream_ref + "\n" + END_COMMAND)
        scanner_ref = self._read_response(rfile)
        if scanner_ref is None:
            return None

        # scanner.useDelimiter("\\A")
        self._send(sock, CALL_COMMAND + scanner_ref + "\nuseDelimiter\n" + STRING_TYPE + _escape("\\A") + "\n" + END_COMMAND)
        self._read_response(rfile)

        # scanner.hasNext()
        self._send(sock, CALL_COMMAND + scanner_ref + "\nhasNext\n" + END_COMMAND)
        has_next_line = self._readline(rfile)
        if has_next_line is None or has_next_line.startswith(ERROR_PREFIX):
            return None
        if has_next_line != "!ybtrue":
            return ""

        # scanner.next()
        self._send(sock, CALL_COMMAND + scanner_ref + "\nnext\n" + END_COMMAND)
        return self._read_string_response(rfile)

    def _read_process_output(self, sock, rfile, process_ref):
        """Read stdout and stderr from a Process reference."""
        # process.getInputStream() → stdout
        self._send(sock, CALL_COMMAND + process_ref + "\ngetInputStream\n" + END_COMMAND)
        stdout_ref = self._read_response(rfile)
        stdout = self._read_stream_via_scanner(sock, rfile, stdout_ref) if stdout_ref else None

        # process.getErrorStream() → stderr
        self._send(sock, CALL_COMMAND + process_ref + "\ngetErrorStream\n" + END_COMMAND)
        stderr_ref = self._read_response(rfile)
        stderr = self._read_stream_via_scanner(sock, rfile, stderr_ref) if stderr_ref else None

        parts = []
        if stdout:
            parts.append(stdout)
        if stderr:
            parts.append(f"[stderr] {stderr}")
        return "\n".join(parts) if parts else ""


if __name__ == "__main__":
    import argparse

    parser = argparse.ArgumentParser(description="Py4j Gateway Client — execute commands on a remote JVM")
    parser.add_argument("--host", default="127.0.0.1", help="Gateway host (default: 127.0.0.1)")
    parser.add_argument("--port", type=int, default=25333, help="Gateway port (default: 25333)")
    parser.add_argument("--token", default="jwUDzpLsNKEFER4*a8gruBH_GsAurNxU7A@Xc", help="Auth token")
    parser.add_argument("command", nargs="?", default="id", help="Command to execute (default: id)")
    args = parser.parse_args()

    client = Py4jGatewayClient(args.host, args.port, args.token)

    if not client.authenticate():
        print("Failed to authenticate with Java Gateway", file=sys.stderr)
        sys.exit(1)

    output = client.run_shell_script_with_output(args.command)
    if output is None:
        print("Command failed (protocol error)", file=sys.stderr)
        sys.exit(1)
    elif output:
        print(output)
    else:
        print("(empty output)", file=sys.stderr)
