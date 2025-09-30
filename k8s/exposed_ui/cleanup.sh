#!/usr/bin/env bash
set -e

PORT=${1:-8100}
echo "Cleaning up..."
# Clean up the job
curl "http://127.0.0.1:$PORT/api/v1/_raw/job/namespace/default/name/curl-job" -X DELETE
echo "Done."