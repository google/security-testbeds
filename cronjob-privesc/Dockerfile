FROM ubuntu:22.04

# Install cron
RUN apt-get update && apt-get install -y cron

# Create an insecure directory for world-writable execution
RUN mkdir -p /opt/insecure_dir && chmod 777 /opt/insecure_dir
COPY scripts/insecure_script.sh /opt/insecure_dir/insecure_script.sh
RUN chmod 755 /opt/insecure_dir/insecure_script.sh

# Create a script with weak file permissions (world-writable)
COPY scripts/weak_script.sh /usr/local/bin/weak_script.sh
RUN chmod 777 /usr/local/bin/weak_script.sh

# --- Injections for cronjobprivesc detector ---

# 1. World-writable directory execution (root cron job)
# Schedule insecure_script.sh to run from world-writable /opt/insecure_dir
RUN echo "*/1 * * * * root /opt/insecure_dir/insecure_script.sh" >> /etc/crontab

# 2. Relative path in cron.d (root cron job)
COPY configs/cron.d/misconfig /etc/cron.d/misconfig
RUN chmod 644 /etc/cron.d/misconfig

# 3. Weak file permissions (world-writable script)
# Schedule the world-writable script in /etc/crontab so it is guaranteed to be scanned
RUN echo "*/2 * * * * root /usr/local/bin/weak_script.sh" >> /etc/crontab

# Keep cron running in the foreground
CMD cron -f
