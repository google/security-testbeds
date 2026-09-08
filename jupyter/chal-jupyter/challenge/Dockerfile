# Copyright 2020 Google LLC
#
# Licensed under the Apache License, Version 2.0 (the "License");
# you may not use this file except in compliance with the License.
# You may obtain a copy of the License at
#
#      https://www.apache.org/licenses/LICENSE-2.0
#
# Unless required by applicable law or agreed to in writing, software
# distributed under the License is distributed on an "AS IS" BASIS,
# WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
# See the License for the specific language governing permissions and
# limitations under the License.
FROM ubuntu:22.04 as chroot

RUN /usr/sbin/useradd -m -u 1000 user

RUN apt-get update \
    && apt-get install -yq --no-install-recommends \
       python3 python3-pip socat

RUN pip3 install jupyter

RUN chmod -R +777 /home/user

RUN mkdir -p /flag

ADD start.sh /start.sh
RUN chmod +777 /start.sh

RUN mkdir -p /logs
RUN touch /logs/log
RUN chmod -R +777 /logs
RUN chmod a=w /logs/log

FROM gcr.io/kctf-docker/challenge@sha256:0f7d757bcda470c3bbc063606335b915e03795d72ba1d8fdb6f0f9ff3757364f

COPY --from=chroot / /chroot

VOLUME /chroot/logs
VOLUME /chroot/home/user
VOLUME /chroot/usr/local/lib/python3.10/dist-packages/jupyter_server/templates

COPY nsjail.cfg /home/user/nsjail.cfg

RUN apt-get update \
    && apt-get install -yq --no-install-recommends cron
RUN apt-get install -y --reinstall rsyslog

ADD cleanup.sh /cleanup.sh
RUN chmod +777 /cleanup.sh
COPY cron /etc/cron.d/cron
RUN chmod 0644 /etc/cron.d/cron
RUN crontab /etc/cron.d/cron

VOLUME /var/log
VOLUME /run
VOLUME /tmp

CMD service rsyslog start; \
    cron;  \
    sed -i "27 a$(cat /flag/flag.txt)" /chroot/usr/local/lib/python3.10/dist-packages/jupyter_server/templates/page.html; \
    kctf_setup \
    && (kctf_drop_privs nsjail -E AUTHFLAG=$(cat /flag/flag-auth.txt) -E ROOTFLAG=$(cat /flag/flag-root.txt) -E PASS=$(cat /flag/password.txt) --config /home/user/nsjail.cfg --port 1337 -- /start.sh &) \
    && tail -F /var/log/syslog 