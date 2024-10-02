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
FROM pytorch/torchserve as chroot

RUN mkdir -p /home/model-server/jars /home/model-server/run /home/model-server/logs
RUN touch /home/model-server/logs/log

ADD pom.xml /home/model-server/jars/pom.xml
ADD torchserve-endpoint-plugin-0.0.1.jar /home/model-server/jars/torchserve-endpoint-plugin-0.0.1.jar

ADD start.sh /start.sh
ADD start2.sh /start2.sh
ADD model.py /model.py

USER root

RUN apt-get update \
    && apt-get install -yq --no-install-recommends \
       curl socat wget

RUN wget https://download.pytorch.org/models/densenet161-8d451a50.pth
RUN torch-model-archiver --model-name flag --version 1.0 --model-file /model.py --serialized-file densenet161-8d451a50.pth --export-path / --handler image_classifier

RUN chmod -R +777 /home/model-server/logs
RUN chmod +777 /start.sh 
RUN chmod +777 /start2.sh 

RUN mkdir -p /flag

FROM europe-west4-docker.pkg.dev/internet-ctf/custom-images/kctf-source

COPY --from=chroot / /chroot
VOLUME /chroot/home/model-server
VOLUME /chroot/home/model-server/logs

COPY nsjail.cfg /home/user/nsjail.cfg

RUN apt-get update \
    && DEBIAN_FRONTEND=noninteractive apt-get install -yq --no-install-recommends tzdata apache2 \
    && ln -fs /usr/share/zoneinfo/Europe/Berlin /etc/localtime \
    && dpkg-reconfigure --frontend noninteractive tzdata \
    && rm -rf /var/lib/apt/lists/*

RUN service apache2 start

# For Proxy
RUN ln -s /etc/apache2/mods-available/proxy.load /etc/apache2/mods-enabled/
RUN ln -s /etc/apache2/mods-available/proxy_http.load /etc/apache2/mods-enabled/

COPY apache2-kctf-nsjail.conf /etc/apache2/conf-enabled/

VOLUME /var/run/apache2

#cronjob logging
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
    && (kctf_drop_privs nsjail -E AUTHFLAG=$(cat /flag/flag.txt) -E ROOTFLAG=$(cat /flag/flag-root.txt) --config /home/user/nsjail.cfg --port 8081 -- /start.sh &) \
    && (kctf_drop_privs nsjail -E AUTHFLAG=$(cat /flag/flag.txt) -E ROOTFLAG=$(cat /flag/flag-root.txt) --config /home/user/nsjail.cfg --port 8082 -- /start2.sh &) \
    && (bash -c 'source /etc/apache2/envvars && APACHE_RUN_USER=user APACHE_RUN_GROUP=user /usr/sbin/apache2 -D FOREGROUND' &)\
    && tail -f /var/log/syslog
