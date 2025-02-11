# Slurm 24 is not available in bookworm
FROM debian:trixie-slim

ARG DEBIAN_FRONTEND=noninteractive

RUN set -ex \
    && apt-get update -y \
    && apt-get install -y \
        slurm-wlm \
        slurmrestd \
        slurm-wlm-basic-plugins \
        slurm-wlm-jwt-plugin \
        munge \
        curl

RUN mkdir -p /etc/sysconfig/slurm \
        /var/spool/slurm \
        /var/run/slurm \
        /var/lib/slurm \
        /var/log/slurm \
        /var/spool/slurm/statesave \
        /run/munge \
        /data
RUN touch /var/lib/slurm/node_state \
        /var/lib/slurm/front_end_state \
        /var/lib/slurm/job_state \
        /var/lib/slurm/resv_state \
        /var/lib/slurm/trigger_state \
        /var/lib/slurm/assoc_mgr_state \
        /var/lib/slurm/assoc_usage \
        /var/lib/slurm/qos_usage \
        /var/lib/slurm/fed_mgr_state

# Generate key for JWT authentication
# RUN dd if=/dev/random of=/var/spool/slurm/statesave/jwt_hs256.key bs=32 count=1

# Let's use a static JWT key for testing
COPY jwt_hs256.key /var/spool/slurm/statesave/jwt_hs256.key

# Set permissions
RUN chown -R slurm:slurm /var/*/slurm*
RUN chown -R munge:munge /run/munge
RUN chmod 0600 /var/spool/slurm/statesave/jwt_hs256.key \
    && chmod 0755 /var/spool/slurm/statesave

COPY slurm.conf /etc/slurm/slurm.conf
COPY cgroup.conf /etc/slurm/cgroup.conf

COPY entrypoint.sh /entrypoint.sh
ENTRYPOINT ["/entrypoint.sh"]