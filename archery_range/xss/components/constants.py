# Copyright 2021 Google LLC. All Rights Reserved.
#
# Licensed under the Apache License, Version 2.0 (the "License");
# you may not use this file except in compliance with the License.
# You may obtain a copy of the License at
#
#     http://www.apache.org/licenses/LICENSE-2.0
#
# Unless required by applicable law or agreed to in writing, software
# distributed under the License is distributed on an "AS IS" BASIS,
# WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
# See the License for the specific language governing permissions and
# limitations under the License.
# ==============================================================================
import os
import string

APP_PORT = int(os.getenv("PORT", 8080))

# Cookie and client storage key used when retrieving and setting stored sources
COOKIE_KEY = os.getenv('AR_COOKIE', 'archery_range')
CLIENT_STORAGE_KEY = os.getenv('AR_STORAGE_KEY', 'archery_range')

# POST/GET parameters used in the reflection source
POST_PARAM_NAME = os.getenv("AR_POST_PARAM", "q")
GET_PARAM_NAME = os.getenv("AR_GET_PARAM", "q")

# List of characters considered safe in an URL
# Used to validate component names during testing
URL_SAFE_CHARS = list(string.ascii_letters) + list(
    string.digits) + [".", "-", "_"]
