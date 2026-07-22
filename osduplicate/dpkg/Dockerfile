FROM debian:bookworm

RUN apt update && apt-get install -y software-properties-common curl

# Verify that spark-core is not available in default repos
RUN ! apt install spark-core

# Install fzf from the default repos
RUN apt install fzf

# Add extra repository
RUN sh -c "echo 'deb [signed-by=/etc/apt/keyrings/dataproc.gpg] https://storage.googleapis.com/dataproc-bigtop-repo/2_3_deb12_20251203_064720-RC01 dataproc contrib' > /etc/apt/sources.list.d/dataproc.list"
RUN sh -c "curl -s https://storage.googleapis.com/dataproc-bigtop-repo/2_3_deb12_20251203_064720-RC01/archive.key | gpg --dearmor -o /etc/apt/keyrings/dataproc.gpg"
RUN apt-get update

# Add extra pkg
RUN apt-get install -y spark-core


COPY verify.sh /usr/bin/verify.sh
RUN chmod +x /usr/bin/verify.sh

ENV DEFAULT_PKG="fzf"
ENV DEFAULT_PKG_FILE="usr/bin/fzf"
ENV EXTRA_PKG="spark-core"
ENV EXTRA_PKG_FILE="usr/lib/spark/jars/spark-core_2.12-3.5.3.jar"
ENV LANGUAGE_EXTRACTORS="go/binary,java/archive"
ENV OS_EXTRACTOR="os/dpkg"
ENV DUP_ANNOTATOR="vex/os-duplicate/dpkg"
