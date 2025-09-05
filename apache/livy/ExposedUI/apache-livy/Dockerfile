#https://github.com/apache/incubator-livy?tab=readme-ov-file#building-livy
# Reuse the same image built for Spark Master/Worker
FROM mounirbs-local/spark-python3-java11:3.5.4
USER root
ENV LIVY_HOME /opt/livy
WORKDIR /opt/
# Get livy binaries from: https://livy.apache.org/download/
RUN apt-get update && apt-get install -y unzip \
    && curl "https://dlcdn.apache.org/incubator/livy/0.8.0-incubating/apache-livy-0.8.0-incubating_2.12-bin.zip" -O \
    && unzip "apache-livy-0.8.0-incubating_2.12-bin" \
    && rm -rf "apache-livy-0.8.0-incubating_2.12-bin.zip" \
    && mv "apache-livy-0.8.0-incubating_2.12-bin" $LIVY_HOME \
    && mkdir $LIVY_HOME/logs \
    && chown -R spark:spark $LIVY_HOME

USER spark
