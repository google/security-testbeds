#Based on https://github.com/ubccr/xdmod/blob/xdmod11.0/.circleci/config.yml
FROM tools-ext-01.ccr.xdmod.org/xdmod-10.5.0-x86_64:rockylinux8.5-0.3
RUN yum update --exclude google-chrome-* -y
RUN yum upgrade --exclude google-chrome-* -y
RUN systemctl enable postfix.service mariadb.service httpd.service
RUN sed -e 's#:443#:80#' -e 's#SSLEngine on#SSLEngine off#g' -i /etc/httpd/conf.d/xdmod.conf
COPY resources.json /etc/xdmod/resources.json2
COPY resource_specs.json /etc/xdmod/resource_specs.json2
RUN jq -s '.[0] + .[1]' /etc/xdmod/resources.json2 /etc/xdmod/resources.json > /tmp/a; cat /tmp/a > /etc/xdmod/resources.json
RUN jq -s '.[0] + .[1]' /etc/xdmod/resource_specs.json2 /etc/xdmod/resource_specs.json > /tmp/a; cat /tmp/a > /etc/xdmod/resource_specs.json

STOPSIGNAL SIGRTMIN+3
VOLUME ["/tmp", "/run", "/run/lock"]
COPY startup.sh /sbin/
CMD [ "/sbin/startup.sh" ]
EXPOSE 8082/tcp
