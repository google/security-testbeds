#!/bin/bash


tensorflow_model_server --port=8500 --rest_api_port=8501 --model_name=${MODEL_NAME} --model_base_path=${MODEL_BASE_PATH}/${MODEL_NAME} > /logs/$(date +%s).log 2>&1 &
socat - TCP:127.0.0.1:8501,forever 