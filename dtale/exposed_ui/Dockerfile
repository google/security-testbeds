FROM python:3.7

WORKDIR /app

RUN pip install dtale==3.18.2
RUN pip install dash_daq==0.5.0

COPY config.ini /config.ini

EXPOSE 40000
CMD ["bash", "-c", "DTALE_CONFIG=/config.ini dtale --host 0.0.0.0 --port 40000"]