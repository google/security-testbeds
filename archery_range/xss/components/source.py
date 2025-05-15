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
from dataclasses import dataclass, field
from collections.abc import Callable
from typing import Union, List
from components.constants import COOKIE_KEY, CLIENT_STORAGE_KEY, POST_PARAM_NAME, GET_PARAM_NAME

@dataclass
class Source:
  """Representation of an XSS Source.

   This dataclass represents XSS sources. The sources feature an implementation
   that implements the actual data source e.g. dom node, reflected string, etc.
   Unlike the sink, the source does not contain a placeholder because it is at
   the
   top of the templating chain.


  Attributes:
    name: A short and unique string used to identify the source using request
      arguments.
    description: A string describing the source for humans.
    implementation: A string implementing the source.
    suggested_processors: List of processor names as strings or an empty list by default
  """
  name: str
  description: str
  implementation: str
  suggested_processors: List[str] = field(default_factory=list)

  def make_implementation(self, flask_request) -> str:
    return self.implementation


@dataclass
class ComplexSource(Source):
  """A complex source is a source which cannot be implemented as simply returning a string.

  Some sources of XSS payloads, especially those used on the server's
  side, need more complex implementation than substituting a template
  with the
  source string definition. An example for this is accessing request
  parameters:
  Request parameters are dynamic and need to be sourced from the Flask
  request argument.

  For this reason, the implementation is a callable function.

  Attributes:
    name: A short and unique string used to identify the source using request
      arguments.
    description: A string describing the source for humans.
    implementation: A callable implementing the source, called by make_implementation().
    suggested_processors: List of processor names as strings or None by default
  """
  implementation: Callable

  def make_implementation(self, flask_request) -> str:
    return self.implementation(flask_request)


def _reflect_url_param(flask_request) -> str:
  """Return the GET_PARAM_NAME parameter of a flask request.

  Return an empty string if the argument was not defined.
  """
  return flask_request.args.get(GET_PARAM_NAME, "")


def _reflect_referrer(flask_request) -> str:
  """Return the referrer header of a flask request.

  Return an empty string if the argument was not defined.
  """
  return flask_request.headers.get("referer", "")


def _reflect_request_host(flask_request) -> str:
  """Return the host sent in request."""
  return flask_request.host


def _reflect_request_path(flask_request) -> str:
  """Return the path sent in request."""
  return flask_request.path


def _reflect_post_param(flask_request) -> str:
  """Return the post parameter POST_PARAM_NAME or an empty string."""
  return flask_request.form.get(POST_PARAM_NAME, "")


def _reflect_cookie(flask_request) -> str:
  """Return the value of archery range cookie or an empty string."""
  return flask_request.cookies.get(COOKIE_KEY, "")


post_message_source = Source(
    name="postMessage",
    description="The data property of a postMessage. To be used with postMessage context.",
    implementation="msgData")

ClientSourcesList = [
    Source(
        name="location.hash",
        description="The value appended to the location including #",
        implementation="location.hash",
        suggested_processors=[
            "substr1",
        ],
    ),
    Source(
        name="document.cookie",
        description=f"The value of the cookie named {COOKIE_KEY} (client-side)",
        implementation=f"document.cookie.match(/{COOKIE_KEY}=(.*)(;\s)?/)[1]"),
    Source(
        name="baseURI",
        description="The absolute base URL of the document",
        implementation="document.baseURI",
        suggested_processors=[
            "urldecode",
        ],
    ),
    Source(
        name="documentURI",
        description="The document location",
        implementation="document.documentURI",
        suggested_processors=[
            "urldecode",
        ],
    ),
    Source(
        name="document.referrer",
        description="The referrer URI that linked to this document (client-side)",
        implementation="document.referrer",
        suggested_processors=[
            "urldecode",
        ],
    ),
    Source(
        name="document.URL",
        description="The document URL",
        implementation="document.URL",
        suggested_processors=[
            "urldecode",
        ],
    ),
    Source(
        name="location",
        description="The document location",
        implementation="document.location",
        suggested_processors=[
            "urldecode",
        ],
    ),
    Source(
        name="location.href",
        description="The document's whole URL",
        implementation="document.location.href",
        suggested_processors=[
            "urldecode",
        ],
    ),
    Source(
        name="location.pathname",
        description="The document's pathname",
        implementation="document.location.pathname",
        suggested_processors=[
            "urldecode",
        ],
    ),
    Source(
        name="location.search",
        description="The query string: e.g. ?param=one",
        implementation="document.location.search",
        suggested_processors=[
            "urldecode",
        ],
    ),
    Source(
        name="location.host",
        description="The document's host",
        implementation="document.location.host",
        suggested_processors=[
            "urldecode",
        ],
    ),
    Source(
        name="location.hostname",
        description="The document's hostname",
        implementation="document.location.hostname",
        suggested_processors=[
            "urldecode",
        ],
    ),
    Source(
        name="location.origin",
        description="The document's origin",
        implementation="document.location.origin",
        suggested_processors=[
            "urldecode",
        ],
    ),
    Source(
        name="location.username",
        description="The document's URL username",
        implementation="document.location.username",
        suggested_processors=[
            "urldecode",
        ],
    ),
    Source(
        name="location.password",
        description="The document's URL password",
        implementation="document.location.password",
        suggested_processors=[
            "urldecode",
        ],
    ),
    Source(
        name="window.name",
        description="The window name",
        implementation="window.name",
    ),
    Source(
        name="sessionStorage",
        description=f"Value taken from the sessionStorage property {CLIENT_STORAGE_KEY}",
        implementation=f"sessionStorage.getItem('{CLIENT_STORAGE_KEY}')"),
    Source(
        name="localStorage",
        description=f"Value taken from the localStorage property '{CLIENT_STORAGE_KEY}'",
        implementation=f"localStorage.getItem('{CLIENT_STORAGE_KEY}')"),
    post_message_source,
]
ServerSourcesList = [
    ComplexSource(
        name="url_param",
        description="The value of the URL parameter q (server-side)",
        implementation=_reflect_url_param),
    ComplexSource(
        name="referrer",
        description="The value of the HTTP referrer header (server-side)",
        implementation=_reflect_referrer),
    ComplexSource(
        name="host",
        description="The value of the HTTP request host (server-side)",
        implementation=_reflect_request_host),
    ComplexSource(
        name="path",
        description="The value of the HTTP request path (server-side)",
        implementation=_reflect_request_path),
    ComplexSource(
        name="post_urlencoded",
        description="The value of the POST parameter q (server-side)",
        implementation=_reflect_post_param),
    ComplexSource(
        name="cookie",
        description=f"The value of the cookie named {COOKIE_KEY} (server-side)",
        implementation=_reflect_cookie),
    post_message_source,
]

ClientSources = {source.name: source for source in ClientSourcesList}
ServerSources = {source.name: source for source in ServerSourcesList}
