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
from dataclasses import dataclass
from collections.abc import Callable
from string import Template
import flask


@dataclass
class Processor:
  """Representation of a processor.

  This dataclass represents processors. Multiple processors may be put between
  sinks and sources in an XSS test chain. They contain placeholders for the
  $payload and may be chained.


  Attributes:
    name: A short and unique string used to identify the processor using request
      arguments.
    description: A string describing the processor for humans.
    implementation: A string implementing the processor. Contains $payload
      placeholder to fill with the source/processed source.
  """
  name: str
  description: str
  implementation: str

  def make_implementation(self, payload) -> str:
    return Template(self.implementation).substitute(payload=payload)


@dataclass
class ComplexProcessor(Processor):
  """A complex processor is a processor which requires more logic than simply returning a template string.

  Some functionality like htmlescaping a string requires to call another method
  with the payload.
  To model those functions performing transformations of the payload before
  returning it, this class is added.
  Instead of returning a template string for the implementation,
  make_implementation does its thing to transform the payload and return the
  result.
  """
  implementation: Callable

  def make_implementation(self, payload) -> str:
    return self.implementation(payload)

# Default processor
none_processor = Processor(
    name="none",
    description="Performs no processing and returns the payload as entered.",
    implementation="$payload")

dquote_processor = Processor(
    name="doublequote",
    description="Surround the payload with double quotes",
    implementation="\"$payload\"")
squote_processor = Processor(
    name="singlequote",
    description="Surround the payload with single quotes",
    implementation="'$payload'")
backtick_processor = Processor(
    name="backticks",
    description="Surround the payload with backticks (ES6 template literal)",
    implementation="`$payload`")
fwslash_processor = Processor(
    name="fwslashes",
    description="Surround the payload with forward slashes",
    implementation="/$payload/")

ClientProcessorsList = [
    none_processor,
    Processor(
        name="substr1",
        description="Take the substring from second character onwards",
        implementation="$payload.substr(1)"),
    Processor(
        name="urldecode",
        description="URL decode the payload",
        implementation="decodeURI($payload)",
    ),
    Processor(
        name="urlencode",
        description="URL encode the payload",
        implementation="encodeURI($payload)",
    ),
    Processor(
        name="unescape",
        description="Apply JavaScript unescape() to the payload",
        implementation="unescape($payload)",
    ),
    Processor(
        name="htmlescape",
        description="HTML-escape the payload",
        implementation=("""$payload"""
                        """.replaceAll('&', '&amp;')"""
                        """.replaceAll('<', '&lt;')"""
                        """.replaceAll('>', '&gt;')"""
                        """.replaceAll('"', '&quot;')"""
                        """.replaceAll("'", '&#039;');""")),
    dquote_processor,
    squote_processor,
    backtick_processor,
    fwslash_processor,
]

ServerProcessorsList = [
    none_processor,
    dquote_processor,
    squote_processor,
    backtick_processor,
    fwslash_processor,
    ComplexProcessor(
        name="htmlescape",
        description="Apply flask's escape method to the payload",
        implementation=flask.escape),
]

ServerProcessors = {
    processor.name: processor for processor in ServerProcessorsList
}
ClientProcessors = {
    processor.name: processor for processor in ClientProcessorsList
}
