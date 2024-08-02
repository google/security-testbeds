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
FROM nodered/node-red:1.1.2 as chroot

RUN npm install --unsafe-perm --no-update-notifier --no-fund --only=production

RUN npm install node-red-dashboard@2.23.0

ADD settings.js /data/settings.js
ADD settings.js /usr/src/node-red/.node-red/settings.js
ADD settings.js /usr/src/node-red/node_modules/node-red/settings.js

ADD start.sh /start.sh

USER root
RUN chmod +rwx /start.sh
RUN apk add socat

RUN mkdir -p /logs
RUN chmod a+wx /logs
RUN chmod -r /logs
RUN chmod a+w /usr/src/node-red/.node-red/

FROM gcr.io/kctf-docker/challenge@sha256:0f7d757bcda470c3bbc063606335b915e03795d72ba1d8fdb6f0f9ff3757364f

COPY --from=chroot / /chroot

VOLUME /chroot/data
VOLUME /chroot/usr/src/node-red
VOLUME /chroot/logs
COPY nsjail.cfg /home/user/

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
    kctf_setup && \
    (kctf_drop_privs nsjail --config /home/user/nsjail.cfg --port 1337 -- /start.sh &) \
    && tail -F /var/log/syslog 