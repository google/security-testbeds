FROM ubuntu:22.04
RUN mkdir /workdir
WORKDIR /workdir
COPY service.py /workdir/
RUN apt update  \
    && apt install curl python3.11 python3-pip python3.11-venv -y
ARG BENTOML_VERSION
RUN pip3 install pydantic==2.8.2 bentoml==${BENTOML_VERSION}
CMD bentoml serve service:Summarization
