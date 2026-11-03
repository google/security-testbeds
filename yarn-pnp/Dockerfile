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

FROM node:22-bookworm-slim

RUN apt-get update && apt-get install -y --no-install-recommends \
    bash \
    ca-certificates \
    && rm -rf /var/lib/apt/lists/*

RUN corepack enable

ENV COREPACK_ENABLE_DOWNLOAD_PROMPT=0

RUN mkdir -p /app
COPY testdata/ /testdata/

RUN cd /testdata/yarn3-inline && \
    corepack yarn install --immutable --mode=skip-build
RUN cd /testdata/yarn4-inline && \
    corepack yarn install --immutable --mode=skip-build
RUN cd /testdata/yarn4-external && \
    corepack yarn install --immutable --mode=skip-build

WORKDIR /app

CMD ["/bin/bash"]
