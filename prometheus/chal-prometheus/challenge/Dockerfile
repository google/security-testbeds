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
FROM ubuntu:24.04 as chroot

ADD start.sh /start.sh
RUN chmod a+x /start.sh

RUN apt-get update \
    && apt-get install -yq --no-install-recommends \
       curl socat jq ca-certificates

RUN curl -s https://api.github.com/repos/prometheus/prometheus/releases/latest  | jq -r '.assets[] | select(.name | endswith(".linux-amd64.tar.gz")) | .browser_download_url' | xargs curl -LO
RUN curl -s https://api.github.com/repos/prometheus/node_exporter/releases/latest | jq -r '.assets[] | select(.name | endswith(".linux-amd64.tar.gz")) | .browser_download_url' | xargs curl -LO


RUN mkdir -p /home/ubuntu/prometheus /home/ubuntu/data /home/ubuntu/node_exporter
RUN tar -xvzf prometheus-*.tar.gz -C /home/ubuntu/prometheus --strip-components=1 && rm prometheus-*.tar.gz
RUN tar -xvzf node_exporter-*.linux-amd64.tar.gz -C /home/ubuntu/node_exporter --strip-components=1 && rm node_exporter-*.linux-amd64.tar.gz
ADD prometheus.yml /home/ubuntu/prometheus/prometheus.yml
RUN chmod -R a+rx /home/ubuntu/prometheus && chmod -R a+wrx /home/ubuntu/data && chmod -R a+rx /home/ubuntu/node_exporter

RUN mkdir -p /logs
RUN chmod -R +777 /logs


FROM europe-west4-docker.pkg.dev/internet-ctf/custom-images/kctf-source

VOLUME /chroot/home/ubuntu/data
VOLUME /chroot/logs

COPY --from=chroot / /chroot

ADD nsjail.cfg /home/user/nsjail.cfg


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
    && kctf_drop_privs nsjail --config /home/user/nsjail.cfg --port 1337 -- /start.sh & \
    tail -f /var/log/syslog
