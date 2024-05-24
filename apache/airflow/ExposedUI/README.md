# vulnerble airflow instance

```bash
# on ubuntu
sudo apt install python3
sudo apt install python3-venv
sudo apt install python3-pip
mkdir airflowWorkSpace
cd airflowWorkSpace
python3 -m venv .venv
source .venv/bin/activate
pip install apache-airflow

mkdir config
export AIRFLOW_HOME="$(pwd)/config"
export AIRFLOW__CORE__TEST_CONNECTION=Enabled

# create and edit config/webserver_config.py file
touch config/webserver_config.py
cat << EOF >> config/webserver_config.py 
from __future__ import annotations
import os
from flask_appbuilder.const import AUTH_DB
basedir = os.path.abspath(os.path.dirname(__file__))
WTF_CSRF_ENABLED = True
WTF_CSRF_TIME_LIMIT = None
AUTH_TYPE = AUTH_DB
AUTH_ROLE_PUBLIC = 'Admin'
EOF
```

run `airflow standalone` and then go to http://127.0.0.1:8080/home there is no auth needed for anything you want to do.
go to http://127.0.0.1:8080/connection/add and select HTTP connection type, you can see the test button is enabled and so we can test out of band call to verify the exposed Dashboard/UI.
ref: https://airflow.apache.org/docs/apache-airflow-providers-fab/stable/auth-manager/webserver-authentication.html#webserver-authentication

# safe airflow instance

```bash
# on ubuntu
sudo apt install python3
sudo apt install python3-venv
sudo apt install python3-pip
mkdir airflowWorkSpaceSafe
cd airflowWorkSpaceSafe
python3 -m venv .venv
source .venv/bin/activate
pip install apache-airflow

mkdir config
export AIRFLOW_HOME="$(pwd)/config"
export AIRFLOW__CORE__TEST_CONNECTION=Enabled

# create and edit config/webserver_config.py file
touch config/webserver_config.py
cat << EOF >> config/webserver_config.py 
from __future__ import annotations
import os
from flask_appbuilder.const import AUTH_DB
basedir = os.path.abspath(os.path.dirname(__file__))
WTF_CSRF_ENABLED = True
WTF_CSRF_TIME_LIMIT = None
AUTH_TYPE = AUTH_DB
EOF
```
