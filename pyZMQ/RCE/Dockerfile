FROM python:3.9
LABEL name="pyzmq_vulnerable_rpc_server"

WORKDIR /app

RUN pip3 install pyzmq==26.2.1
COPY pyZMQ_server.py /app
COPY pyZMQ_exploit.py /app

EXPOSE 5555
