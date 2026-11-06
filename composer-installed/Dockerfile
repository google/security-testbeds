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

FROM docker.io/library/composer:1.10.27 AS composer1

COPY testdata/packages/legacy-library/ /packages/legacy-library/
COPY testdata/composer1/composer.json /project/composer.json
RUN composer install \
    --working-dir=/project \
    --no-interaction \
    --no-plugins \
    --no-scripts \
    --no-progress

FROM docker.io/library/composer:2.8.12 AS composer2

COPY testdata/packages/runtime-library/ /packages/runtime-library/
COPY testdata/packages/dev-tool/ /packages/dev-tool/
COPY testdata/composer2/composer.json /project/composer.json
RUN composer install \
    --working-dir=/project \
    --no-interaction \
    --no-plugins \
    --no-scripts \
    --no-progress

FROM docker.io/library/php:8.3-cli-bookworm

RUN mkdir -p /app /testdata
COPY --from=composer1 /project/ /testdata/composer1/
COPY --from=composer2 /project/ /testdata/composer2/

WORKDIR /app

CMD ["/bin/bash"]
