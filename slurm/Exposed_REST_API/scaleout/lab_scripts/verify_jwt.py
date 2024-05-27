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

if len(sys.argv) != 2:
    sys.exit("verify_jwt.py [JWT Token]");

with open("/etc/slurm/jwt.key", "rb") as f:
    priv_key = f.read()

signing_key = jwk_from_dict({
    'kty': 'oct',
    'k': b64encode(priv_key)
})

a = JWT()
b = a.decode(sys.argv[1], signing_key, algorithms=["HS256"])
print(b)
