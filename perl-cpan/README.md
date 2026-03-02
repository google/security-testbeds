# OSV-Scalibr: Perl Package Manager CPAN Extractor

This directory contains the test Dockerfile for testing OSV-Scalibr Perl Package Manager CPAN Extractor plugin. The Comprehensive Perl Archive Network (CPAN) currently has 10,000 Perl modules in 10,000 distributions, written by 10,000 authors, mirrored on 1 server. Each CPAN package contains a META.json file that stores their metadata. This plugin finds and extracts these files to determine the inventory.

## Setup

```sh
docker build -t cpan-test .
docker run -it --rm -v $(pwd):/app cpan-test (to put scalibr binary inside the container)
```
