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
FROM grafana/grafana-enterprise as chroot

USER root
RUN mkdir -p /usr/share/grafana/logs
RUN chmod a+wrx -R /usr/share/grafana
RUN mkdir -p /flag

RUN apk update \
&& apk upgrade \
&& apk add socat 

ADD start.sh /start.sh
RUN chmod a+rwx /start.sh

ADD grafana.db /var/lib/grafana/grafana.db
RUN chmod a+rwx /var/lib/grafana/grafana.db

FROM gcr.io/kctf-docker/challenge@sha256:0f7d757bcda470c3bbc063606335b915e03795d72ba1d8fdb6f0f9ff3757364f

COPY --from=chroot / /chroot

ADD nsjail.cfg /home/user/nsjail.cfg

RUN apt-get update \
    && apt-get install -yq --no-install-recommends sqlite3 cron
RUN apt-get install -y --reinstall rsyslog

ADD cleanup.sh /cleanup.sh
RUN chmod +777 /cleanup.sh
COPY cron /etc/cron.d/cron
RUN chmod 0644 /etc/cron.d/cron
RUN crontab /etc/cron.d/cron

VOLUME /var/log
VOLUME /run
VOLUME /tmp

VOLUME /chroot/usr/share/grafana
VOLUME /chroot/var/lib/grafana

CMD service rsyslog start; \
    cron;  \
    sqlite3 /chroot/var/lib/grafana/grafana.db "UPDATE user SET password = '$(cat /flag/password.txt)' WHERE id = 1;"; \
    sqlite3 /chroot/var/lib/grafana/grafana.db "UPDATE dashboard SET slug = '$(cat /flag/flag-auth.txt)', title = '$(cat /flag/flag-auth.txt)', data = '{\"schemaVersion\":17,\"title\":\"$(cat /flag/flag-auth.txt)\",\"uid\":\"bdor3q2sgq2o0c\",\"version\":1}' WHERE id = 1;"; \
    kctf_setup \
    && (kctf_drop_privs nsjail -E ROOTFLAG=$(cat /flag/flag-root.txt) --disable_rlimits --config /home/user/nsjail.cfg --port 1337 -- /start.sh &) \
    && tail -F /var/log/syslog 