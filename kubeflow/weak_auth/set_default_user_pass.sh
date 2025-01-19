#!/bin/bash
set -e

kubectl delete secret dex-passwords -n auth
kubectl create secret generic dex-passwords --from-literal=DEX_USER_PASSWORD='$2y$12$sKB5soXKbQam1kM7z648l.Xss9xdM8vUgDOHOld8RqpVsWTtNwQ1y' -n auth
kubectl delete pods --all -n auth

echo "set password to 12341234"