# Apache Pinot Exposed UI

This directory contains instructions to set up an exposed Apache Pinot UI.

## Setup

1. Run Apache Pinot

   ```sh
   docker run -d -p 9000:9000 -p 8000:8000 apachepinot/pinot:1.4.0 QuickStart -type batch
   ```

2. Visit the Admin UI at http://localhost:9000
