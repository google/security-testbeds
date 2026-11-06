# Copyright 2026 Google LLC
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

FROM ubuntu:22.04

RUN apt-get update && apt-get install -y --no-install-recommends \
    bash \
    sqlite3 \
    && rm -rf /var/lib/apt/lists/*

RUN mkdir -p /app /var/db/pkg/jq-1.7.1

COPY testdata/packages.sql /tmp/packages.sql
RUN sqlite3 /var/db/pkg/local.sqlite < /tmp/packages.sql && \
    rm /tmp/packages.sql

COPY testdata/jq-manifest.json /var/db/pkg/jq-1.7.1/+MANIFEST

# The container runs on Linux, but the extractor uses os-release metadata to
# build the FreeBSD ecosystem suffix. Provide the values from the represented
# FreeBSD installation after all Ubuntu package installation is complete.
RUN printf '%s\n' \
    'NAME=FreeBSD' \
    'ID=freebsd' \
    'VERSION_ID=14.0' \
    'PRETTY_NAME="FreeBSD 14.0"' \
    > /etc/os-release

WORKDIR /app

CMD ["/bin/bash"]
