#
#     https://www.apache.org/licenses/LICENSE-2.0
#
# Unless required by applicable law or agreed to in writing, software
# distributed under the License is distributed on an "AS IS" BASIS,
# WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
# See the License for the specific language governing permissions and
# limitations under the License.
FROM ubuntu:22.04 as chroot

RUN /usr/sbin/useradd --no-create-home -u 1000 user

RUN apt-get update && \
    DEBIAN_FRONTEND=noninteractive \
    apt-get -y install \
    unzip \
    wget \
    curl \
    socat \
    default-jre-headless && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/*

RUN echo $(curl -s https://h2o-release.s3.amazonaws.com/h2o/latest_stable.html | grep -o 'rel-.*index.html' | sed 's/rel-//' | sed 's/index.html//') > /version
RUN cat /version | sed '0,/\//{s/\//\./}' | sed 's/\///g' > /zipver
RUN wget https://h2o-release.s3.amazonaws.com/h2o/rel-$(cat /version)h2o-$(cat /zipver).zip
RUN unzip h2o-$(cat /zipver).zip
RUN mkdir /h2o-$(cat /zipver)/h2o /flag

RUN chown user /h2o-$(cat /zipver)

ADD startup.sh /
RUN chmod +777 /startup.sh

RUN mkdir -p /logs
RUN touch /logs/log
RUN chmod -R +777 /logs
RUN chmod a=w /logs/log

FROM gcr.io/kctf-docker/challenge@sha256:0f7d757bcda470c3bbc063606335b915e03795d72ba1d8fdb6f0f9ff3757364f
COPY --from=chroot / /chroot

# setup to reflect flag in ui
RUN apt-get update && DEBIAN_FRONTEND=noninteractive apt-get -y install default-jdk
RUN mv /chroot/h2o-$(cat /chroot/zipver)/h2o.jar /chroot/h2o-$(cat /chroot/zipver)/h2o/h2o.jar
RUN mkdir /chroot/h2o && mv /chroot/h2o-$(cat /chroot/zipver)/* /chroot/h2o
WORKDIR /chroot/h2o/h2o
RUN jar xf h2o.jar
RUN rm h2o.jar

VOLUME /chroot/logs
VOLUME /chroot/flag
VOLUME /chroot/h2o

ADD nsjail.cfg /

RUN sed -i "s/version/$(cat /chroot/zipver)/g" /nsjail.cfg

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

# adds password and loads flag
CMD service rsyslog start; \
    cron;  \
    echo "user: MD5:$(cat /flag/pass.txt)" > /chroot/h2o/realm.properties; \
    sed -i "12 a$(cat /flag/uiflag.txt)" /chroot/h2o/h2o/www/flow/index.html; \
    jar cmf ./META-INF/MANIFEST.MF ../h2o.jar *; \
    kctf_setup && \
    kctf_drop_privs nsjail -E ROOTFLAG=$(cat /flag/rootflag.txt) --config /nsjail.cfg --port 1337 -- /startup.sh & \
    tail -f /var/log/syslog 

