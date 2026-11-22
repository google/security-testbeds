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
FROM duonghuuphuc/tomcat-8.5.32 as chroot

# Set up your Tomcat environment
RUN /usr/sbin/useradd --no-create-home -u 1000 user

# Adding permitions
RUN chmod -R 777 /usr/local/tomcat

# Scripts
COPY start.sh /usr/local/bin/start.sh
RUN chmod +x /usr/local/bin/start.sh

# Creating the directory
RUN mkdir -p /home/user

# Installing socat
RUN echo 'deb http://archive.debian.org/debian/ stretch main' > /etc/apt/sources.list
RUN apt-get update; exit 0
RUN apt-get install socat -y --force-yes; exit 0

#GCP Logging
RUN mkdir -p /logs
RUN chmod -R +777 /logs

# Switch to the nsjail image
FROM gcr.io/kctf-docker/challenge@sha256:0f7d757bcda470c3bbc063606335b915e03795d72ba1d8fdb6f0f9ff3757364f

COPY --from=chroot / /chroot
RUN chown -Rc user /chroot/home/user

#Cron
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

# Define your nsjail configuration file (nsjail.cfg) and copy it into the container
COPY nsjail.cfg /home/user/nsjail.cfg

#Declare a volume
VOLUME /chroot/home/user/
VOLUME /chroot/usr/local/tomcat
VOLUME /chroot/logs

# Set the default command to execute nsjail with your configuration file
CMD service rsyslog start; \
    cron;  \
    kctf_setup && kctf_drop_privs nsjail --config /home/user/nsjail.cfg --port 1337 -- /usr/local/bin/start.sh & \ 
    tail -f /var/log/syslog
