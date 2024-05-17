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
FROM jenkins/jenkins:lts-jdk17 as chroot

USER root
RUN apt-get update; exit 0
RUN apt-get install socat -y --force-yes; exit 0


ADD jenkins_home /jenkins_home
ADD example_job /example_job
ADD start.sh /start.sh
RUN chmod +777 /start.sh
RUN chown -R jenkins:jenkins /jenkins_home /example_job
RUN chmod -R +777 /jenkins_home /example_job


VOLUME /tmp

RUN mkdir -p /log /flag
RUN chmod +777 /log
RUN chown -R jenkins:jenkins /log
RUN touch /log/logs
RUN chmod a=w /log/logs


FROM gcr.io/kctf-docker/challenge@sha256:0f7d757bcda470c3bbc063606335b915e03795d72ba1d8fdb6f0f9ff3757364f

COPY --from=chroot / /chroot

VOLUME /chroot/var/jenkins_home/
VOLUME /chroot/log
VOLUME /chroot/flag


COPY nsjail.cfg /home/user/nsjail.cfg

CMD kctf_setup \
    && kctf_drop_privs nsjail -E PASS=$(cat /flag/password.txt) -E ROOTFLAG=$(cat /flag/flag-root.txt) -E AUTHFLAG=$(cat /flag/flag-auth.txt) --config /home/user/nsjail.cfg --port 1337 -- /start.sh & \
    tail -f /chroot/log/logs

