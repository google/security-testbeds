# Use a base image for Apache Zeppelin
FROM apache/zeppelin:0.11.2

# Install necessary Python packages and Spark dependencies
USER root

# Install Python 3 and pip
RUN apt-get update && apt-get install -y python3 python3-pip python3-dev && \
    apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PySpark
RUN pip3 install pyspark

# Set environment variables for Spark and PySpark
ENV SPARK_HOME=/opt/spark
ENV PYSPARK_PYTHON=python3
ENV PYSPARK_DRIVER_PYTHON=python3

# Download and install Apache Spark
RUN curl -O https://archive.apache.org/dist/spark/spark-3.4.0/spark-3.4.0-bin-hadoop3.tgz && \
    tar -xzf spark-3.4.0-bin-hadoop3.tgz -C /opt/ && \
    mv /opt/spark-3.4.0-bin-hadoop3 /opt/spark && \
    rm spark-3.4.0-bin-hadoop3.tgz

# Ensure Zeppelin config directory exists and update zeppelin-env.sh
RUN mkdir -p /opt/zeppelin/conf && \
    echo "export SPARK_HOME=/opt/spark" >> /opt/zeppelin/conf/zeppelin-env.sh && \
    echo "export PYSPARK_PYTHON=python3" >> /opt/zeppelin/conf/zeppelin-env.sh && \
    echo "export PYSPARK_DRIVER_PYTHON=python3" >> /opt/zeppelin/conf/zeppelin-env.sh

# Expose the Zeppelin default port
EXPOSE 8080

# Entrypoint to start Zeppelin
ENTRYPOINT ["/opt/zeppelin/bin/zeppelin.sh"]
