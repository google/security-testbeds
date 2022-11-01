# Testbeds for Security Scanner

This project aims to provide a central repository for testbeds contents usable
to assert the quality and functionality of security scanners. This includes
0-day and 1-day scanning capabilities.

## Testbed contents

The tesbed contents are logically grouped into different sub projects. E.g.,
the `archery_range` is the 0-day testbed hosting different applications that
help to assert functionality and quality of a 0-day black box scanner. Each
subfolder provides detailed instructions on the type of vulnerabilities it hosts
and provides instructions for setting up and running the testbed containers.

For now, we merely provide the testbed contents source, but we might, in the 
future, provided a uniform build setup for all of the testbed applications.

## Contributing

Read how to [contribute](CONTRIBUTING.md).

## Source Code Headers

Every file containing source code must include copyright and license
information. This includes any JS/CSS files that you might be serving out to
browsers. (This is to help well-intentioned people avoid accidental copying that
doesn't comply with the license.)

Apache header:

```
Copyright 2022 Google LLC

Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at

    https://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License.
```

## Disclaimer

Security Testbeds is not an officially supported Google product.
