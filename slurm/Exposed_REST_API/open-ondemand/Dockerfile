FROM treydock/ood:latest
COPY ood_portal.yml /etc/ood/config/ood_portal.yml
COPY scaleout.yaml /etc/ood/config/clusters.d/scaleout.yml
RUN /opt/ood/ood-portal-generator/sbin/update_ood_portal
COPY entrypoint.sh /entrypoint.sh
RUN chmod 0755 /entrypoint.sh

RUN mkdir -p /usr/local/bin/
COPY sbatch scancel scontrol squeue /usr/local/bin/
RUN chmod 0755 /usr/local/bin/{sbatch,scancel,scontrol,squeue}

RUN mkdir -m 0777 -p /var/www/ood/apps/sys/dashboard/log/

CMD "/entrypoint.sh"
