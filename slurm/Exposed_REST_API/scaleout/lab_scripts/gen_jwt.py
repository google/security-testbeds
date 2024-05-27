#!/usr/bin/env python3
import sys
import os
import pprint
import json
import time
from datetime import datetime, timedelta, timezone

from jwt import JWT
from jwt.jwa import HS256
from jwt.jwk import jwk_from_dict
from jwt.utils import b64decode,b64encode

if len(sys.argv) != 3:
    sys.exit("gen_jwt.py [user name] [expiration time (seconds)]");

with open("/etc/slurm/jwt.key", "rb") as f:
    priv_key = f.read()

signing_key = jwk_from_dict({
    'kty': 'oct',
    'k': b64encode(priv_key)
})

message = {
    "exp": int(time.time() + int(sys.argv[2])),
    "iat": int(time.time()),
    "sun": sys.argv[1]
}

a = JWT()
compact_jws = a.encode(message, signing_key, alg='HS256')
print("SLURM_JWT={}".format(compact_jws))
