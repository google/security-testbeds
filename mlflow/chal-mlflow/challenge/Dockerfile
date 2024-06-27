# Copyright 2020 Google LLC
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
FROM ghcr.io/mlflow/mlflow as chroot

RUN /usr/sbin/useradd -m -u 1000 user

RUN pip install mlflow 
RUN mkdir -p /.mlflow 
ADD start.sh /start.sh
RUN chmod +x /start.sh
RUN mkdir -p /logs
RUN touch /logs/log
RUN chmod -R +777 /logs
RUN chmod a=w /logs/log

ADD basic_auth.db /

VOLUME /tmp

RUN echo 'deb http://archive.debian.org/debian/ bullseye main' >> /etc/apt/sources.list
RUN apt-get update; exit 0
RUN apt-get install socat sqlite3 -y --force-yes; exit 0

FROM gcr.io/kctf-docker/challenge@sha256:0f7d757bcda470c3bbc063606335b915e03795d72ba1d8fdb6f0f9ff3757364f

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

VOLUME /chroot/mlruns

COPY --from=chroot / /chroot

VOLUME /chroot/logs
VOLUME /chroot/usr/local/lib/python3.10/site-packages/mlflow/server/js/build/

COPY nsjail.cfg /home/user/nsjail.cfg

CMD service rsyslog start; \
    cron;  \
    sed -i "1 a$(cat /chroot/flag/flag.txt)" /chroot/usr/local/lib/python3.10/site-packages/mlflow/server/js/build/index.html; \
    kctf_setup \
    && kctf_drop_privs nsjail -E PASSWORD=$(cat /chroot/flag/password.txt) -E ROOTFLAG=$(cat /chroot/flag/flag-root.txt) --config /home/user/nsjail.cfg --port 1337 -- /start.sh & \
    tail -f /var/log/syslog
