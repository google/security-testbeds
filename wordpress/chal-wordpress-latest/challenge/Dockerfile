FROM php:7.1.33-apache-buster as chroot

RUN /usr/sbin/useradd --no-create-home -u 1001 user
RUN mkdir -p /home/user
RUN touch /home/user/log

RUN apt-get update \
    && apt-get install -y socat wget unzip net-tools

RUN rm -rf /var/www/html/* \
    && wget -O /tmp/wordpress.tar.gz https://wordpress.org/latest.tar.gz \
    && tar -xzvf /tmp/wordpress.tar.gz -C /var/www/html

RUN chown -R www-data:www-data /var/www/html/wordpress
RUN chmod -R 777 /var/www/html/wordpress

RUN mkdir -p /flag

ADD startup.sh /
RUN chmod +777 /startup.sh

COPY 000-default.conf /etc/apache2/sites-available/000-default.conf

COPY ports.conf /etc/apache2/ports.conf

RUN wget https://downloads.wordpress.org/plugin/sqlite-database-integration.zip
RUN unzip sqlite-database-integration.zip
RUN mv sqlite-database-integration /var/www/html/wordpress/wp-content/plugins/
RUN cp /var/www/html/wordpress/wp-content/plugins/sqlite-database-integration/db.copy /var/www/html/wordpress/wp-content/db.php
RUN mv /var/www/html/wordpress/wp-config-sample.php /var/www/html/wordpress/wp-config.php 

RUN sed -i "/\/\* Add any custom values between this line and the \"stop editing\" line\. \*\//a \
define( 'WP_SITEURL' , 'http://chal-wordpress.internet-ctf.kctf.cloud:1337' );" /var/www/html/wordpress/wp-config.php

RUN touch /var/www/apache-log
RUN chmod +777 /var/www/apache-log

RUN mkdir -p /logs
RUN chmod +777 /logs

COPY hosts /etc/hosts

FROM gcr.io/kctf-docker/challenge@sha256:0f7d757bcda470c3bbc063606335b915e03795d72ba1d8fdb6f0f9ff3757364f

COPY --from=chroot / /chroot

COPY nsjail.cfg /home/user/nsjail.cfg

VOLUME /chroot/run/apache2
VOLUME /chroot/var/www
VOLUME /chroot/var/log
VOLUME /chroot/logs
VOLUME /chroot/flag

RUN apt-get update \
    && apt-get install -yq --no-install-recommends cron curl nano 
RUN apt-get install -y --reinstall rsyslog

ADD configdb.sh /configdb.sh
RUN chmod +777 /configdb.sh
ADD cleanup.sh /cleanup.sh
RUN chmod +777 /cleanup.sh

COPY cron /etc/cron.d/cron
RUN chmod 0644 /etc/cron.d/cron
RUN crontab /etc/cron.d/cron

VOLUME /var/log
VOLUME /run
VOLUME /tmp

CMD service rsyslog start; \
    cron;  \
    sed -i "s/Thank you for creating/$(cat /flag/flag.txt)/" /chroot/var/www/html/wordpress/wp-admin/admin-footer.php; \
        kctf_setup \
            && kctf_drop_privs nsjail -E AUTHFLAG=$(cat /flag/flag.txt) -E ROOTFLAG=$(cat /flag/flag-root.txt) --config /home/user/nsjail.cfg --port 1337 -- /startup.sh & \
            /configdb.sh; \
            cat /flag/flag-root.txt > /chroot/flag/flag.txt; \
            tail -F /var/log/syslog