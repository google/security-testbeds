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
1. Run `airflow standalone`. You can now navigate to `http://localhost:8080/home`. Notice that no authorization is needed to access the panel.
2. Navigate to `http://localhost:8080/connection/add`. From there, you can select the HTTP connection type.
3. Notice that the Test button is enabled. With it, you can test the out-of-band interaction.

You can find the reference here: [https://airflow.apache.org/docs/apache-airflow-providers-fab/stable/auth-manager/webserver-authentication.html#webserver-authentication](https://airflow.apache.org/docs/apache-airflow-providers-fab/stable/auth-manager/webserver-authentication.html#webserver-authentication)

# safe airflow instance
Unlike the unsafe setup, here the `AUTH_ROLE_PUBLIC = 'Admin'` is removed from the `config/webserver_config.py` file. Moreover, we don't export the `AIRFLOW__CORE__TEST_CONNECTION=Enabled` environment variable.

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

1. Run `airflow standalone`. You can now navigate to [http://localhost:8080/home](http://localhost:8080/home).
2. Notice that, this time, you need to be authenticated to hit the endpoint. As a result of this, you will be redirect to the `/login` page.
