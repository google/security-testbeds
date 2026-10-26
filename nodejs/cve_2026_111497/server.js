/**
 * Copyright 2026 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     https://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

const express = require('express');

const app = express();
const port = Number(process.env.PORT || 3000);
const host = process.env.HOST || '0.0.0.0';

// Standard Express body parsers automatically decompress Content-Encoding: br
// request bodies via Node.js's built-in zlib.createBrotliDecompress().
// Note: When Content-Encoding is set, body-parser measures the decompressed
// byte length against its default 100kb limit rather than the compressed size.
app.use(express.json());
app.use(express.urlencoded({ extended: true }));

app.get('/', (req, res) => {
  res.status(200).json({
    service: 'cve-2026-111497-testbed',
    nodeVersion: process.version,
    brotliVersion: process.versions.brotli,
    endpoints: ['/', '/api', '/graphql'],
  });
});

app.post('*', (req, res) => {
  res.status(200).json({
    ok: true,
    path: req.path,
    received: req.body || {},
  });
});

// Express error handler for decompression or JSON parse failures.
app.use((err, req, res, next) => {
  if (res.headersSent) {
    return next(err);
  }
  const status = err.status || err.statusCode || 400;
  res.status(status).json({
    ok: false,
    error: err.code || err.type || err.name || 'BadRequestError',
    message: err.message || 'Invalid request body',
  });
});

app.listen(port, host, () => {
  console.log(
      `CVE-2026-111497 testbed listening on http://${host}:${port} ` +
      `(node=${process.version}, brotli=${process.versions.brotli})`);
});
