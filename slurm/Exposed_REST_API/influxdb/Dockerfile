FROM influxdb:2.0
USER root:root

COPY setup.sh /setup.sh
RUN chmod 0755 /setup.sh
RUN echo 'log-level: debug' >> /etc/defaults/influxdb2/config.yml
