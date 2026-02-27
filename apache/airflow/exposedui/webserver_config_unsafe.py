from __future__ import annotations
import os
from flask_appbuilder.const import AUTH_DB
basedir = os.path.abspath(os.path.dirname(__file__))
WTF_CSRF_ENABLED = True
WTF_CSRF_TIME_LIMIT = None
AUTH_TYPE = AUTH_DB
AUTH_ROLE_PUBLIC = 'Admin'