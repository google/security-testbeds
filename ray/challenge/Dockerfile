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

RUN /usr/sbin/useradd --no-create-home -u 1000 user

RUN mkdir -p /home/user

VOLUME /tmp

RUN apt-get update \
    && apt-get install -yq --no-install-recommends \
        python3 python3-pip socat wget curl

RUN pip install -U "ray[default]"

ADD startup.sh /
RUN chmod +777 /startup.sh

RUN mkdir -p /logs
RUN touch /logs/log
RUN chmod +777 -R /logs
RUN mkdir -p /home/user/ray
RUN chmod +777 -R /home/user

FROM europe-west4-docker.pkg.dev/internet-ctf/custom-images/kctf-source

COPY --from=chroot / /chroot

COPY nsjail.cfg /home/user/nsjail.cfg

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

# # For Proxy
RUN ln -s /etc/apache2/mods-available/proxy.load /etc/apache2/mods-enabled/
RUN ln -s /etc/apache2/mods-available/proxy_http.load /etc/apache2/mods-enabled/

ADD apache2-kctf-nsjail.conf /etc/apache2/conf-enabled/

VOLUME /var/run/apache2

VOLUME /chroot/var/log
VOLUME /chroot/logs
VOLUME /chroot/home/user

RUN apt-get update \
    && apt-get install -yq --no-install-recommends cron curl nano 
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
        && kctf_drop_privs nsjail --config /home/user/nsjail.cfg --port 1337 -- /startup.sh & \
    tail -F /var/log/syslog 