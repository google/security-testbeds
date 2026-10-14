#!/usr/bin/env python3
# -*- coding: utf-8 -*-
# Copyright 2020 Google LLC
#
# Licensed under the Apache License, Version 2.0 (the "License");
# you may not use this file except in compliance with the License.
# You may obtain a copy of the License at
#
#     https://www.apache.org/licenses/LICENSE-2.0
#
# Unless required by applicable law or agreed to in writing, software
# distributed under the License is distributed on an "AS IS" BASIS,
# WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
# See the License for the specific language governing permissions and
# limitations under the License.
# MLflow server URL
import requests

mlflow_url = "http://localhost:1337"  

health_endpoint = mlflow_url + "/health"

response = requests.get(health_endpoint)

if response.status_code == 200:
    print("MLflow server is healthy")
    exit(0) 
else:
    print("MLflow server is not healthy")
    exit(1)  