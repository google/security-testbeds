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
FROM httpd:2.4.49 as chroot

RUN /usr/sbin/useradd --no-create-home -u 1000 user

COPY httpd.no-cgid.conf /usr/local/apache2/conf/httpd.conf

RUN mkdir -p /usr/local/apache2/logs
RUN chmod -R 777 /usr/local/apache2/logs
RUN mkdir -p /usr/local/apache2/htdocs
COPY index.html /usr/local/apache2/htdocs
COPY start_apache.sh /usr/local/bin/start_apache.sh
RUN chmod +x /usr/local/bin/start_apache.sh
RUN mkdir -p /home/user

USER root
RUN echo 'deb http://archive.debian.org/debian/ rodete main' >> /etc/apt/sources.list
RUN apt-get update; exit 0
RUN apt-get install socat -y --force-yes; exit 0

RUN mkdir -p /logs
RUN touch /logs/log
RUN chmod -R +777 /logs

FROM gcr.io/kctf-docker/challenge@sha256:0f7d757bcda470c3bbc063606335b915e03795d72ba1d8fdb6f0f9ff3757364f

COPY --from=chroot / /chroot
RUN chown -Rc user /chroot/home/user

VOLUME /chroot/logs

VOLUME /chroot/usr/local/apache2/logs
COPY nsjail.cfg /home/user/nsjail.cfg

CMD kctf_setup \
    && (kctf_drop_privs nsjail --config /home/user/nsjail.cfg --port 1337 -- /usr/local/bin/start_apache.sh) & \
    tail -f /chroot/logs/log
