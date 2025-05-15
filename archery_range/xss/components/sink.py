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
from components.context import ContextCategory

@dataclass
class Sink:
  """Representation of an XSS Sink.

  This dataclass represents XSS sinks. The sinks feature an implementation that
  is used fill with processed source by the request handler.


  Attributes:
    name: A short and unique string used to identify the sink using request
      arguments.
    description: A string describing the sink for humans.
    implementation: A string implementing the sink. Contains $payload
      placeholder to fill with processed source.
    supported_context: ContextCategory enum specifying into which kind of context the sink must be placed.
  """
  name: str
  description: str
  implementation: str
  supported_context: ContextCategory


ClientSinksList = [
    Sink(
        name="svg.script.xlink_href",
        description="Creates a script element inside an svg element under the xlink namespace and places the payload in the href attribute.",
        implementation=(
            """var xmlns = "http://www.w3.org/2000/svg";"""
            """var svgElement = document.createElementNS(xmlns,"svg");"""
            """svgElement.setAttributeNS("http://www.w3.org/2000/xmlns/","xmlns:xlink","http://www.w3.org/1999/xlink");"""
            """var scriptElement = document.createElementNS(xmlns,"script");"""
            """scriptElement.setAttributeNS("http://www.w3.org/1999/xlink","xlink:href",$payload);"""
            """svgElement.appendChild(scriptElement);"""
            """document.documentElement.appendChild(svgElement);"""),
        supported_context=ContextCategory.JS,
    ),
    Sink(
        name="svg.a.xlink_href",
        description="Creates an anchor element inside an svg element under the xlink namespace and places the payload in the href attribute.",
        implementation=(
            """var xmlns = "http://www.w3.org/2000/svg";"""
            """var svgElement = document.createElementNS(xmlns,"svg");"""
            """svgElement.setAttributeNS("http://www.w3.org/2000/xmlns/","xmlns:xlink","http://www.w3.org/1999/xlink");"""
            """var anchorElement = document.createElementNS(xmlns,"a");"""
            """anchorElement.setAttributeNS("http://www.w3.org/1999/xlink","xlink:href",$payload);"""
            """var text = document.createElementNS(xmlns,"text");"""
            """text.setAttribute("y", 30);"""
            """text.textContent = "Trigger";"""
            """anchorElement.appendChild(text);"""
            """svgElement.appendChild(anchorElement);"""
            """document.documentElement.appendChild(svgElement);"""),
        supported_context=ContextCategory.JS,
    ),
    Sink(
        name="setTimeout",
        description="Sets the payload as the target of a timeout after 1ms",
        implementation="setTimeout($payload, 1)",
        supported_context=ContextCategory.JS,
    ),
    Sink(
        name="setInterval",
        description="Sets the payload as the target of an interval of every 1ms",
        implementation="setInterval($payload, 1)",
        supported_context=ContextCategory.JS,
    ),
    Sink(
        name="script.innerText",
        description="Creates a script element, appends it to the document and sets its innerText to the payload",
        implementation=("const el = document.createElement('script');"
                        "el.id = 'XSS';"
                        "document.documentElement.appendChild(el);"
                        "const elXSS = document.getElementById('XSS');"
                        "elXSS.innerText = $payload;"),
        supported_context=ContextCategory.JS,
    ),
    Sink(
        name="script.textContent",
        description="Creates a script element, appends it to the document and sets its textContent to the payload",
        implementation=("const el = document.createElement('script');"
                        "el.id = 'XSS';"
                        "document.documentElement.appendChild(el);"
                        "const elXSS = document.getElementById('XSS');"
                        "elXSS.textContent = $payload;"),
        supported_context=ContextCategory.JS,
    ),
    Sink(
        name="eval",
        description="The eval() function evaluates JavaScript code represented as a string.",
        implementation="eval($payload)",
        supported_context=ContextCategory.JS,
    ),
    Sink(
        name="function",
        description="Create a new function object from the payload and call it",
        implementation="new Function($payload)()",
        supported_context=ContextCategory.JS,
    ),
    Sink(
        name="document.write",
        description="write() will clear and rewrite the document with the payload",
        implementation="document.write($payload)",
        supported_context=ContextCategory.JS,
    ),
    Sink(
        name="document.writeln",
        description="writeln() will clear and rewrite the document with the payload and add a new line",
        implementation="document.writeln($payload)",
        supported_context=ContextCategory.JS,
    ),
    Sink(
        name="location",
        description="Set document.location to the payload",
        implementation="document.location = $payload",
        supported_context=ContextCategory.JS,
    ),
    Sink(
        name="location.assign",
        description="Execute document.location.assign with the payload",
        implementation="document.location.assign($payload)",
        supported_context=ContextCategory.JS,
    ),
    Sink(
        name="location.replace",
        description="Replace document.location with the payload",
        implementation="document.location.replace($payload)",
        supported_context=ContextCategory.JS,
    ),
    Sink(
        name="window.open",
        description="Open the payload in a new window",
        implementation="window.open($payload)",
        supported_context=ContextCategory.JS,
    ),
    Sink(
        name="innerHTML",
        description="Creates an element, appends it to the document and sets its innerHTML to the payload.",
        implementation=("const div = document.createElement('div');"
                        "div.id = 'XSS';"
                        "document.documentElement.appendChild(div);"
                        "const divXSS = document.getElementById('XSS');"
                        "divXSS.innerHTML = $payload;"),
        supported_context=ContextCategory.JS,
    ),
    Sink(
        name="outerHTML",
        description="Creates an element, appends it to the document and sets (and replace) its outerHTML to the payload.",
        implementation=("const div = document.createElement('div');"
                        "div.id = 'XSS';"
                        "document.documentElement.appendChild(div);"
                        "const divXSS = document.getElementById('XSS');"
                        "divXSS.outerHTML = $payload;"),
        supported_context=ContextCategory.JS,
    ),
    Sink(
        name="adjacentHTML",
        description="Creates an element, appends it to the document and sets its adjacentHTML 'beforebegin' to the payload.",
        implementation=("const div = document.createElement('div');"
                        "div.id = 'XSS';"
                        "document.documentElement.appendChild(div);"
                        "const divXSS = document.getElementById('XSS');"
                        "divXSS.insertAdjacentHTML('beforebegin', $payload);"),
        supported_context=ContextCategory.JS,
    ),
    Sink(
        name="adjacentHTMLafterbegin",
        description="Creates an element, appends it to the document and sets its adjacentHTML 'afterbegin' to the payload.",
        implementation=("const div = document.createElement('div');"
                        "div.id = 'XSS';"
                        "document.documentElement.appendChild(div);"
                        "const divXSS = document.getElementById('XSS');"
                        "divXSS.insertAdjacentHTML('afterbegin', $payload);"),
        supported_context=ContextCategory.JS,
    ),
    Sink(
        name="object.param.code",
        description="Creates and object and sets the code attribute of an inner parameter to the payload",
        implementation=(
            """const objectElement = document.createElement("object");"""
            """const paramCodeElement = document.createElement("param");"""
            """paramCodeElement.name = "code";"""
            """paramCodeElement.value = $payload;"""
            """objectElement.appendChild(paramCodeElement);"""
            """document.documentElement.appendChild(objectElement);"""),
        supported_context=ContextCategory.JS,
    ),
    Sink(
        name="object.param.movie",
        description="Creates and object and sets the movie attribute of an inner parameter to the payload",
        implementation=(
            """const objectElement = document.createElement("object");"""
            """const paramMovieElement = document.createElement("param");"""
            """paramMovieElement.name = "movie";"""
            """paramMovieElement.value = $payload;"""
            """objectElement.appendChild(paramMovieElement);"""
            """document.documentElement.appendChild(objectElement);"""),
        supported_context=ContextCategory.JS,
    ),
    Sink(
        name="object.param.src",
        description="Creates and object and sets the src attribute of an inner parameter to the payload",
        implementation=(
            """const objectElement = document.createElement("object");"""
            """const paramSrcElement = document.createElement("param");"""
            """paramSrcElement.name = "src";"""
            """paramSrcElement.value = $payload;"""
            """objectElement.appendChild(paramSrcElement);"""
            """document.documentElement.appendChild(objectElement);"""),
        supported_context=ContextCategory.JS,
    ),
    Sink(
        name="object.param.url",
        description="Creates and object and sets the url attribute of an inner parameter to the payload",
        implementation=(
            """const objectElement = document.createElement("object");"""
            """const paramUrlElement = document.createElement("param");"""
            """paramUrlElement.name = "url";"""
            """paramUrlElement.value = $payload;"""
            """objectElement.appendChild(paramUrlElement);"""
            """document.documentElement.appendChild(objectElement);"""),
        supported_context=ContextCategory.JS,
    ),
    Sink(
        name="range.createContextualFragment",
        description="Create a document fragment from the parsed payload",
        implementation=(
            """const div = document.createElement('div');"""
            """div.id = 'divEl';"""
            """document.documentElement.appendChild(div);"""
            """const range = document.createRange();"""
            """range.selectNode(document.getElementById("divEl"));"""
            """const documentFragment = range.createContextualFragment($payload);"""
            """document.documentElement.appendChild(documentFragment);"""),
        supported_context=ContextCategory.JS,
    ),
    Sink(
        name="angular.parse",
        description="Execute Angular's $parse on the payload",
        implementation=("angular.module('test', [])"
                        ".controller('VulnerableController', "
                        "['$$parse', function($$parse) {"
                        "$$parse($payload)({});"
                        "}]);"),
        supported_context=ContextCategory.Angular,
    ),
    Sink(
        name="form.action",
        description="Create a form and set its action attribute to the payload",
        implementation=("""const form = document.createElement("form");"""
                        """form.setAttribute("action", $payload);"""
                        """form.innerHTML = "<input type=submit />";"""
                        """document.documentElement.appendChild(form);"""),
        supported_context=ContextCategory.Angular,
    ),
    Sink(
        name="a.href",
        description="Create an anchor element and set its href property to the payload",
        implementation=("""const anchor = document.createElement("a");"""
                        """anchor.href = $payload;"""
                        """anchor.text = "click";"""
                        """document.documentElement.appendChild(anchor);"""),
        supported_context=ContextCategory.Angular,
    ),
]

ServerSinksList = [
    Sink(
        name="reflect",
        description="Reflects the payload to the client",
        implementation="$payload",
        supported_context=ContextCategory.ALL,
    ),
]

ClientSinks = {sink.name: sink for sink in ClientSinksList}
ServerSinks = {sink.name: sink for sink in ServerSinksList}
