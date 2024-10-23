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
FROM python:3.10-slim as chroot

RUN /usr/sbin/useradd -m -u 1000 user

RUN apt-get update \
    && apt-get install -yq --no-install-recommends \
       python3 python3-pip socat nano

#Install socat
USER root
RUN echo 'deb http://archive.debian.org/debian/ rodete main' >> /etc/apt/sources.list
RUN apt-get update; exit 0
RUN apt-get install socat -y --force-yes; exit 0

RUN pip3 install numpy --upgrade
RUN pip3 install dm-tree       
RUN pip3 install dm-reverb[tensorflow]
RUN pip3 install tensorrt
RUN pip3 install flask
RUN pip3 install numpy --upgrade; pip3 install dm-tree; pip3 install dm-reverb[tensorflow]

#Copy
RUN chmod +777 /home/user
ADD script.py /home/user
ADD app.py /home/user
RUN chmod +777 /home/user/script.py
RUN chmod +777 /home/user/app.py
RUN chmod +777 /dev/random
RUN chmod +777 /dev/urandom

RUN mkdir -p /logs
RUN touch /logs/log
RUN chmod -R +777 /logs
RUN chmod a=w /logs/log

ADD start.sh /home/user/start.sh
RUN chmod a+wx /home/user/start.sh

FROM europe-west4-docker.pkg.dev/internet-ctf/custom-images/kctf-source

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

VOLUME /chroot/usr/local/lib/python3.10/dist-packages
VOLUME /chroot/dev
VOLUME /chroot/logs
COPY --from=chroot / /chroot

VOLUME /chroot/home/user

COPY nsjail.cfg /home/user/

CMD service rsyslog start; \
    cron;  \
    kctf_setup && \
    kctf_setup \
    && kctf_drop_privs nsjail --config /home/user/nsjail.cfg --port 1337 -- /home/user/start.sh \
    && tail -F /var/log/syslog 