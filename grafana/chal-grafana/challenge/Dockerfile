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

FROM europe-west4-docker.pkg.dev/internet-ctf/custom-images/kctf-source

COPY --from=chroot / /chroot

ADD nsjail.cfg /home/user/nsjail.cfg



# Apache config
RUN apt-get update \
    && DEBIAN_FRONTEND=noninteractive apt-get install -yq --no-install-recommends tzdata apache2 \
    && ln -fs /usr/share/zoneinfo/Europe/Berlin /etc/localtime \
    && dpkg-reconfigure --frontend noninteractive tzdata \
    && rm -rf /var/lib/apt/lists/*

# config mod security
RUN apt-get update && apt-get install libapache2-mod-security2 -y
RUN a2enmod security2

ADD modsecurity.conf /etc/modsecurity/modsecurity.conf

RUN service apache2 start

# For Proxy
RUN ln -s /etc/apache2/mods-available/proxy.load /etc/apache2/mods-enabled/
RUN ln -s /etc/apache2/mods-available/proxy_http.load /etc/apache2/mods-enabled/


COPY apache2-kctf-nsjail.conf /etc/apache2/conf-enabled/

VOLUME /var/run/apache2

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
    && (kctf_drop_privs nsjail -E ROOTFLAG=$(cat /flag/flag-root.txt) --disable_rlimits --config /home/user/nsjail.cfg --port 8080 -- /start.sh &) \
    && (bash -c 'source /etc/apache2/envvars && APACHE_RUN_USER=user APACHE_RUN_GROUP=user /usr/sbin/apache2 -D FOREGROUND' &)\
    && tail -f /var/log/syslog /var/log/apache2/modsec_audit.log

