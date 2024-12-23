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
FROM ubuntu:20.04 as chroot

# Create user
RUN /usr/sbin/useradd --no-create-home -u 1000 user
RUN mkdir -p /home/user

RUN mkdir -p /flag

RUN apt-get update \
    && apt-get install -y socat wget unzip net-tools curl gnupg2

ADD config.sh /
RUN chmod +777 config.sh 

# COPY hosts /etc/hosts

# Install InfluxDB
RUN wget -q https://repos.influxdata.com/influxdata-archive_compat.key \
    && echo '393e8779c89ac8d958f81f942f9ad7fb82a25e133faddaf92e15b16e6ac9ce4c influxdata-archive_compat.key' | sha256sum -c \
    && cat influxdata-archive_compat.key | gpg --dearmor | tee /etc/apt/trusted.gpg.d/influxdata-archive_compat.gpg > /dev/null \
    && echo 'deb [signed-by=/etc/apt/trusted.gpg.d/influxdata-archive_compat.gpg] https://repos.influxdata.com/debian stable main' | tee /etc/apt/sources.list.d/influxdata.list \
    && apt-get update \
    && apt-get install -y influxdb2 \
    && apt-get clean

# Expose InfluxDB default port
EXPOSE 8086


# # Run InfluxDB as the command
# CMD ["influxd"]

RUN touch /root/.influxdbv2
RUN chmod -R a+w /root/.influxdbv2
RUN chmod -R a+w /home/user
RUN chmod -R a+w /etc/influxdb

# ==============================================================================================================================

RUN mkdir -p /logs
RUN chmod -R +777 /logs


FROM europe-west4-docker.pkg.dev/internet-ctf/custom-images/kctf-source

COPY --from=chroot / /chroot

VOLUME /chroot/logs

COPY nsjail.cfg /home/user/

# VOLUME /chroot/root/.influxdbv2

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

ADD apache2-kctf-nsjail.conf /etc/apache2/conf-enabled/

VOLUME /var/run/apache2


VOLUME /chroot/etc/influxdb
VOLUME /chroot/logs
VOLUME /chroot/home/user

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
    cron; \
    kctf_setup \
        && (kctf_drop_privs nsjail -E AUTHFLAG=$(cat /flag/flag.txt) --config /home/user/nsjail.cfg --port 8082 -- /config.sh &) \
        && (bash -c 'source /etc/apache2/envvars && APACHE_RUN_USER=user APACHE_RUN_GROUP=user /usr/sbin/apache2 -D FOREGROUND' &)\
        && tail -f /var/log/syslog /var/log/apache2/modsec_audit.log
