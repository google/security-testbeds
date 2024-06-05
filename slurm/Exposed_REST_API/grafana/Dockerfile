FROM grafana/grafana:latest
USER root:root
RUN apk add wget
COPY grafana.ini /etc/grafana/grafana.ini
COPY influxdb.yaml /etc/grafana/provisioning/datasources/influxdb.yaml
COPY dashboards.yaml /etc/grafana/provisioning/dashboards/dashboards.yaml
RUN mkdir -p /var/lib/grafana/dashboards
RUN wget 'https://grafana.com/api/dashboards/11057/revisions/1/download' -O /var/lib/grafana/dashboards/11057.json
