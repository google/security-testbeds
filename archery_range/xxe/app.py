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
"""The entry point for the Flask app that is serving the XXE testbed."""
import os
import subprocess

from flask import Blueprint
from flask import Flask
from flask import make_response
from flask import render_template
from flask import request

app = Flask(__name__)

blueprint = Blueprint("xxe", __name__, template_folder="templates")


@app.route("/")
def health():
  return make_response("XXE testbed is healthy!")


@blueprint.route("/")
def index():
  return render_template("index.html")


@blueprint.route("/reflect_xml_post_page", methods=["GET"])
def xxe_reflect_xml_post_page():
  return render_template("reflect_xml_post.html")


@blueprint.route("/reflect_xml_post_endpoint", methods=["POST"])
def xxe_reflect_xml_post_endpoint():
  if not request.data:
    return make_response("Missing data in the request body!", 400)
  try:
    processed_xml = process_xml(request.data)
  except ValueError:
    return make_response("Could not parse the provided XML!", 400)

  response = make_response(processed_xml, 200)
  response.headers["Content-Type"] = "text/xml"
  return response


def process_xml(xml_string):
  process = subprocess.Popen(["xmllint", "--noent", "-"],
                             stdin=subprocess.PIPE,
                             stdout=subprocess.PIPE,
                             stderr=subprocess.PIPE)
  [stdout, stderr] = process.communicate(xml_string)
  if stderr:
    raise ValueError("XML could not be parsed")
  return stdout


if __name__ == "__main__":
  app.register_blueprint(blueprint, url_prefix="/xxe")

  app.run(host="0.0.0.0", port=int(os.environ.get("PORT", 8080)))
