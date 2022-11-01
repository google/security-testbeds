# Copyright 2021 Google LLC. All Rights Reserved.
#
# Licensed under the Apache License, Version 2.0 (the "License");
# you may not use this file except in compliance with the License.
# You may obtain a copy of the License at
#
#     http://www.apache.org/licenses/LICENSE-2.0
#
# Unless required by applicable law or agreed to in writing, software
# distributed under the License is distributed on an "AS IS" BASIS,
# WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
# See the License for the specific language governing permissions and
# limitations under the License.
# ==============================================================================
"""The entry point for Flask App serving the testbed's content."""
import os
from flask import Flask
from flask import render_template
from blueprints.mysql.mysql import mysql_blueprint
from blueprints.postgresql.postgresql import postgresql_blueprint
from custom_message_error import CustomMessageError

app = Flask(__name__)
app.register_blueprint(postgresql_blueprint, url_prefix="/sqli/postgresql")
app.register_blueprint(mysql_blueprint, url_prefix="/sqli/mysql")


@app.route("/")
@app.route("/sqli/")
def index():
  return render_template("index.html")


@app.errorhandler(CustomMessageError)
def custom_message_error_handler(e):
  return render_template(
      "error.html", error_code=e.status_code,
      error_message=e.message), e.status_code

if __name__ == "__main__":
  app.run(host="0.0.0.0", port=int(os.environ.get("PORT", 8080)))
