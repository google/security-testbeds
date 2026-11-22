FROM jenkins/jenkins:2.562

# Switch to root to modify files if needed
USER root

# Copy your custom config.xml into Jenkins home
COPY config.xml /var/jenkins_home/config.xml

# Fix permissions (important!)
RUN chown jenkins:jenkins /var/jenkins_home/config.xml

# Switch back to Jenkins user
USER jenkins
