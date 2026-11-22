#!/bin/bash

bentoml serve service:Summarization > /logs/$(date +%s).log 2>&1 &

socat - TCP:127.0.0.1:3000,forever