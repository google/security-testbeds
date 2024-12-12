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
FROM jetty as chroot

RUN java -jar $JETTY_HOME/start.jar --add-module=ee10-deploy

ADD webapp.war $JETTY_BASE/webapps/ROOT.war

ADD start.sh /start.sh

RUN cd $JETTY_HOME

USER root
RUN apt-get update \
    && apt-get install -yq --no-install-recommends \
        socat 

RUN chmod a+x /start.sh
RUN chmod -R a+wrx /var/lib/jetty


RUN mkdir -p /logs
RUN chmod -R +777 /logs

FROM europe-west4-docker.pkg.dev/internet-ctf/custom-images/kctf-source

VOLUME /chroot/var/lib/jetty
VOLUME /chroot/logs

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
        && (kctf_drop_privs nsjail --config /home/user/nsjail.cfg --port 8080 -- /start.sh &) \
        && (bash -c 'source /etc/apache2/envvars && APACHE_RUN_USER=user APACHE_RUN_GROUP=user /usr/sbin/apache2 -D FOREGROUND' &)\
        && tail -f /var/log/syslog /var/log/apache2/modsec_audit.log
