# Copyright 2026 Google LLC
#
# Licensed under the Apache License, Version 2.0 (the "License");
# you may not use this file except in compliance with the License.
# You may obtain a copy of the License at
#
#     https://www.apache.org/licenses/LICENSE-2.0
#
# Unless required by applicable law or agreed to in writing, software
# distributed under the License is distributed on an "AS IS" BASIS,
# WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
# See the License for the specific language governing permissions and
# limitations under the License.

# Note: Alpine v3.16 through v3.20 on dl-cdn.alpinelinux.org were patched
# on 2026-11-05 06:53 UTC (e.g. 9.7_p1-r6 in v3.20 adds `strlen(pw_password) > 3`
# in sys_auth_passwd).
# Alpine 3.15 (EOL) ships the unpatched openssh-server 8.8_p1-r1 (and musl 1.2.2).
FROM alpine:3.15

# 1. Install standard non-PAM openssh-server (8.8_p1-r1) and shadow utilities
RUN apk add --no-cache openssh-server shadow

# 2. Generate SSH host keys
RUN ssh-keygen -A

# 3. Precondition A: At least one user in /etc/shadow must have a $-prefixed
#    hash ($5$ or $6$) so OpenSSH's pick_salt() selects SHA-256/SHA-512
#    instead of falling back to "xx" (traditional DES).
RUN useradd -m -s /bin/sh donoruser && \
    echo "donoruser:DonorPassword123!" | chpasswd

# 4. Precondition B: Target account has literal '*' in /etc/shadow and a login shell.
#    Note: Unlike alpine:3.20 (which ships with `root:*::0:::::`), vanilla
#    alpine:3.15 ships with `root:!::0:::::`, so we set `*` on `root` (matching
#    newer Alpine defaults probed by scanners) as well as `targetuser`.
RUN usermod -p '*' root && \
    useradd -m -s /bin/sh targetuser && \
    usermod -p '*' targetuser

# 5. Precondition C: PasswordAuthentication yes and PermitRootLogin yes
RUN sed -i 's/^#*PasswordAuthentication.*/PasswordAuthentication yes/' /etc/ssh/sshd_config && \
    sed -i 's/^#*PermitRootLogin.*/PermitRootLogin yes/' /etc/ssh/sshd_config

EXPOSE 22

# Run sshd in foreground with error/debug output to stderr
CMD ["/usr/sbin/sshd", "-D", "-e"]
