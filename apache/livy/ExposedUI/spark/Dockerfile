# https://github.com/apache/spark-docker/tree/master
# https://hub.docker.com/_/spark/tags
# Simulating Microsoft Fabric Runtime 1.3(with Apache Livy), Spark 3.5, Java 11
FROM spark:3.5.4-python3
USER root
RUN apt-get update && apt-get install -y curl

# Install Python Dependencies
COPY ./requirements.txt /opt/   
RUN pip install -r /opt/requirements.txt

# Apache Livy exception using Java 17 
# Exception in thread "main" java.util.concurrent.ExecutionException: javax.security.sasl.SaslException: Client closed before SASL negotiation finished.

# Using Java 11
# https://jdk.java.net/archive/
WORKDIR /opt/java/
RUN curl "https://download.java.net/java/GA/jdk11/9/GPL/openjdk-11.0.2_linux-x64_bin.tar.gz" -o openjdk-update.tar.gz \
    && tar -xzf "openjdk-update.tar.gz" \
    && rm -rf openjdk openjdk-update.tar.gz \
    && mv jdk-* openjdk

USER spark
