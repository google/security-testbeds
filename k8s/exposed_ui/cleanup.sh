#!/usr/bin/env bash
set -e

echo "Cleaning up..."
# Clean up the job
curl 'http://127.0.0.1:8100/api/v1/namespaces/kubernetes-dashboard/services/http:kubernetes-dashboard:/proxy/api/v1/_raw/job/namespace/default/name/curl-job' -X DELETE
echo "Done."