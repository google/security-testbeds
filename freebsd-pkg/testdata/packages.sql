-- Copyright 2026 Google LLC
--
-- Licensed under the Apache License, Version 2.0 (the "License");
-- you may not use this file except in compliance with the License.
-- You may obtain a copy of the License at
--
--     https://www.apache.org/licenses/LICENSE-2.0
--
-- Unless required by applicable law or agreed to in writing, software
-- distributed under the License is distributed on an "AS IS" BASIS,
-- WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
-- See the License for the specific language governing permissions and
-- limitations under the License.

CREATE TABLE packages (
  id INTEGER PRIMARY KEY,
  origin TEXT UNIQUE NOT NULL,
  name TEXT NOT NULL,
  version TEXT NOT NULL,
  comment TEXT NOT NULL,
  desc TEXT NOT NULL,
  arch TEXT NOT NULL,
  maintainer TEXT NOT NULL,
  prefix TEXT NOT NULL,
  flatsize INTEGER NOT NULL,
  automatic INTEGER NOT NULL,
  licenselogic INTEGER NOT NULL
);

INSERT INTO packages (
  origin,
  name,
  version,
  comment,
  desc,
  arch,
  maintainer,
  prefix,
  flatsize,
  automatic,
  licenselogic
) VALUES
  (
    'ftp/curl',
    'curl',
    '8.4.0',
    'Command line tool and library for transferring data with URLs',
    'curl is a command line tool and library for transferring data with URLs.',
    'freebsd:14:x86:64',
    'ports@FreeBSD.org',
    '/usr/local',
    4200000,
    0,
    1
  ),
  (
    'security/openssl',
    'openssl',
    '3.0.12',
    'TLS protocol implementation',
    'OpenSSL provides cryptographic and TLS protocol support.',
    'freebsd:14:x86:64',
    'ports@FreeBSD.org',
    '/usr/local',
    7600000,
    0,
    1
  );
