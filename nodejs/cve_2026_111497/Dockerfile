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

# Vulnerable Node.js 22.22.0 image bundling unpatched Brotli 1.2.0
# (CVE-2026-111497).
FROM node:22.22.0-slim
LABEL name="nodejs_cve_2026_111497_vulnerable"

WORKDIR /usr/src/app

COPY package.json ./
RUN npm install --omit=dev

COPY server.js ./

EXPOSE 3000
CMD ["node", "server.js"]
