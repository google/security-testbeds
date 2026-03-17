#!/bin/bash
set -e

kubectl delete secret dex-passwords -n auth
kubectl create secret generic dex-passwords --from-literal=DEX_USER_PASSWORD='$2y$12$ug0Hi0KkY2ndHCz53CJI/.6fOL.K3q363BOQBgld590g2zzpvFbIK' -n auth
kubectl delete pods --all -n auth

echo "new password to fk21455FLEPRIQ"
