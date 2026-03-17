FROM php

USER root

COPY startup.sh /
RUN chmod 0744 /startup.sh

COPY index.php /var/www/html/

RUN apt-get update && \
    apt-get install -y procps cron

EXPOSE 80

# Start crond and phpd
ENTRYPOINT ["/startup.sh"]
CMD ["php", "-S", "0.0.0.0:80", "-t", "/var/www/html", "/var/www/html/index.php"]


