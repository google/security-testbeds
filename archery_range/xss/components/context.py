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
import re
import flask
from enum import Enum


class ContextCategory(Enum):
  ALL = 0
  innerHTML = 1
  JS = 2
  Angular = 3
  HTMLAttribute = 4
  HTMLComment = 5
  HTMLTag = 6
  HTMLAttributeSrc = 7
  HTMLAttributeHref = 8

@dataclass
class Context:
  """Representation of an XSS Context.

  This dataclass represents XSS contexts. The contexts define where the XSS
  source is mapped to in terms of browser parsing evaluation.


  Attributes:
    name: A short and unique string used to identify the context using request
      arguments.
    description: A string describing the context for humans.
    implementation: A string implementing the context. Contains $payload
      placeholder to fill with sink.
    category: The ContextCategory enum categorizing the context on a high level.
  """
  name: str
  description: str
  implementation: str
  category: ContextCategory

  def make_implementation(self, flask_request) -> str:
    return self.implementation


@dataclass
class ComplexContext(Context):
  """A complex context is a context which requires more logic than simply returning a template string.

  Some functionality like slightly switching the context based on a request
  argument require a method to handle the implementation.
  To model those functions performing transformations of the payload before
  returning it, this class is added.
  Instead of returning a template string for the implementation,
  make_implementation does its thing to transform the payload and return the
  result.
  """
  implementation: Callable
  base_template: str

  def make_implementation(self, flask_request) -> str:
    return self.implementation(self.base_template, flask_request)

# Default context
body_context = Context(
    name="body",
    description="The HTML body",
    implementation="<body>$payload</body>",
    category=ContextCategory.innerHTML,
)

script_context = Context(
    name="script",
    description="Inside a script tag",
    implementation="<script>$payload</script>",
    category=ContextCategory.JS,
)

# Source: https://www.w3schools.com/tags/ref_eventattributes.asp
body_events = [
    "onafterprint",
    "onbeforeprint",
    "onbeforeunload",
    "onerror",
    "onhashchange",
    "onload",
    "onmessage",
    "onoffline",
    "ononline",
    "onpagehide",
    "onpageshow",
    "onpopstate",
    "onresize",
    "onstorage",
    "onunload",
]
form_events = [
    "onblur",
    "onchange",
    "oncontextmenu",
    "onfocus",
    "oninput",
    "oninvalid",
    "onreset",
    "onsearch",
    "onselect",
    "onsubmit",
]
keyboard_events = [
    "onkeydown",
    "onkeypress",
    "onkeyup",
]
mouse_events = [
    "onclick",
    "ondblclick",
    "onmousedown",
    "onmousemove",
    "onmouseout",
    "onmouseover",
    "onmouseup",
    "onwheel",
]
drag_events = [
    "ondrag",
    "ondragend",
    "ondragenter",
    "ondragleave",
    "ondragover",
    "ondragstart",
    "ondrop",
    "onscroll",
]
clipboard_events = [
    "oncopy",
    "oncut",
    "onpaste",
]

event_contexts = [
    Context(
        name=f"body.{event}",
        description=f"Inside an HTML attribute event handler for {event} of the body tag",
        implementation=f"<body {event}=$payload></body>",
        category=ContextCategory.JS,
    ) for event in body_events
] + [
    Context(
        name=f"form.{event}",
        description=f"Inside an HTML attribute event handler for {event} of a form tag with one input and a submit button",
        implementation=f"<form {event}=$payload><input type=text /><input type=submit /></form>",
        category=ContextCategory.JS,
    ) for event in form_events
] + [
    Context(
        name=f"input.{event}",
        description=f"Inside an HTML attribute event handler for {event} of an input tag",
        implementation=f"<input {event}=$payload />",
        category=ContextCategory.JS,
    ) for event in keyboard_events + clipboard_events
] + [
    Context(
        name=f"button.{event}",
        description=f"Inside an HTML attribute event handler for {event} of a button tag",
        implementation=f"<button {event}=$payload>Click or drag</button>",
        category=ContextCategory.JS,
    ) for event in mouse_events + drag_events
] + [
    Context(
        name="details.ontoggle",
        description="Inside an HTML attribute event handler for ontoggle of a details tag",
        implementation="<details ontoggle=$payload>Reveal</details>",
        category=ContextCategory.JS,
    )
]

post_message_context = Context(
    name="postMessage",
    description="In a postMessage handler inside a script tag. To be used with postMessage source",
    implementation=(
        "<script>"
        "const postMessageHandler = (msg) => {"
        "const msgData = msg.data;"
        "$payload"
        "};"
        """window.addEventListener("message", postMessageHandler, false);"""
        "</script>"),
    category=ContextCategory.JS,
)

def _create_angular_context(base_template, flask_request) -> str:
  # Default to Angular version 1.6.0
  angular_version = flask_request.args.get("angular", "1.6.0")
  if not re.match(r"^(\d+\.)?(\d+\.)?(\d+)?$", angular_version):
    flask.abort(
        400,
        "Invalid Angular version. Use dot separated version string e.g. 1.6.0")
  return Template(base_template).substitute(version=angular_version)


angular_contexts = [
    ComplexContext(
        name="angular",
        description="Inside a script tag with Angular loaded and an Angular app element",
        base_template=(
            """<script src="//ajax.googleapis.com/ajax/libs/angularjs/$version/angular.js"></script>"""
            "<script>$$payload</script>"
            """<div ng-app="test" ng-controller="VulnerableController" class="ng-scope"></div>"""
        ),
        implementation=_create_angular_context,
        category=ContextCategory.JS,
    ),
    ComplexContext(
        name="angular.ng-class",
        description="As the ng-class attribute of a generic tag with loaded Angular ",
        base_template=(
            """<script src="//ajax.googleapis.com/ajax/libs/angularjs/$version/angular.js"></script>"""
            "<body ng-app><tag ng-class=$$payload /></body>"),
        implementation=_create_angular_context,
        category=ContextCategory.Angular,
    ),
    ComplexContext(
        name="angular.ng-class",
        description="As the ng-class attribute of a generic tag with loaded Angular ",
        base_template=(
            """<script src="//ajax.googleapis.com/ajax/libs/angularjs/$version/angular.js"></script>"""
            "<body ng-app><tag ng-class=$$payload /></body>"),
        implementation=_create_angular_context,
        category=ContextCategory.Angular,
    ),
    ComplexContext(
        name="angular.attribute.interpolation",
        description=("Inside interpolation symbols in a "
                     "generic attribute of a generic tag with loaded Angular"),
        base_template=(
            """<script src="//ajax.googleapis.com/ajax/libs/angularjs/$version/angular.js"></script>"""
            "<body ng-app><tag class={{$$payload}} /></body>"),
        implementation=_create_angular_context,
        category=ContextCategory.Angular,
    ),
    ComplexContext(
        name="angular.interpolation",
        description="Into interpolation symbols inside the body tag with Angular loaded",
        base_template=(
            """<script src="//ajax.googleapis.com/ajax/libs/angularjs/$version/angular.js"></script>"""
            """<body ng-app><div>{{$$payload}}</div></body>"""),
        implementation=_create_angular_context,
        category=ContextCategory.Angular,
    ),
    ComplexContext(
        name="angular.interpolation.altsymbols",
        description="Into alternate interpolation symbols [[]] inside the body tag with Angular loaded",
        base_template=(
            """<script src="//ajax.googleapis.com/ajax/libs/angularjs/$version/angular.js"></script>"""
            """<script>"""
            """angular.module('ng').config(function($$$$interpolateProvider) {"""
            """$$$$interpolateProvider.startSymbol('[[').endSymbol(']]');});"""
            """</script>"""
            """<body ng-app>[[$$payload]]</body>"""),
        implementation=_create_angular_context,
        category=ContextCategory.Angular,
    ),
    ComplexContext(
        name="angular.body",
        description="Inside the body tag with Angular loaded",
        base_template=(
            """<script src="//ajax.googleapis.com/ajax/libs/angularjs/$version/angular.js"></script>"""
            """<body ng-app>$$payload</body>"""),
        implementation=_create_angular_context,
        category=ContextCategory.Angular,
    ),
    ComplexContext(
        name="angular.body.altsymbols",
        description="Inside the body tag with Angular loaded using alternate interpolation symbols [[]]",
        base_template=(
            """<script src="//ajax.googleapis.com/ajax/libs/angularjs/$version/angular.js"></script>"""
            """<script>"""
            """angular.module('ng').config(function($$$$interpolateProvider) {"""
            """$$$$interpolateProvider.startSymbol('[[').endSymbol(']]');});"""
            """</script>"""
            """<body ng-app>$$payload</body>"""),
        implementation=_create_angular_context,
        category=ContextCategory.Angular,
    ),
]

ClientContextsList = [
    script_context,
    post_message_context,
] + event_contexts + angular_contexts

ServerContextsList = [
    body_context,
    script_context,
    post_message_context,
    Context(
        name="body.comment",
        description="A comment inside the HTML body",
        implementation="<body><!-- $payload --></body>",
        category=ContextCategory.HTMLComment,
    ),
    Context(
        name="script.comment.block",
        description="Inside a javascript comment block in a script tag",
        implementation="<script>/* $payload */</script>",
        category=ContextCategory.JS,
    ),
    Context(
        name="script.comment.line",
        description="Inside a javascript line comment in a script tag",
        implementation="<script>// $payload</script>",
        category=ContextCategory.JS,
    ),
    Context(
        name="script.comment.html",
        description="Inside an HTML comment block in a script tag",
        implementation="<script><!-- $payload </script>",
        category=ContextCategory.JS,
    ),
    Context(
        name="script.assignment",
        description="In a javascript variable assignment",
        implementation="""<script>var a = $payload </script>""",
        category=ContextCategory.JS,
    ),
    Context(
        name="script.src",
        description="As the src attribute of a script tag",
        implementation="""<script src=$payload />""",
        category=ContextCategory.HTMLAttributeSrc,
    ),
    Context(
        name="script.function.parameter",
        description="As a function parameter to a JS function call inside a script tag",
        implementation="""<script>const f = (a) => { return a }; f($payload); </script>""",
        category=ContextCategory.JS,
    ),
    Context(
        name="attribute.name",
        description="As an attribute name of a generic tag",
        implementation="""<tag $payload=""/>""",
        category=ContextCategory.HTMLAttribute,
    ),
    Context(
        name="attribute.generic",
        description="As the value of a generic attribute in a generic tag",
        implementation="""<tag attribute=$payload />""",
        category=ContextCategory.HTMLAttribute,
    ),
    Context(
        name="tag.inner",
        description="Inside a generic tag",
        implementation="<tag>$payload</tag>",
        category=ContextCategory.innerHTML,
    ),
    Context(
        name="tag.name.self_closing",
        description="As a name of a self-closing tag",
        implementation="<$payload />",
        category=ContextCategory.HTMLTag,
    ),
    Context(
        name="tag.name",
        description="As a tag name",
        implementation="<$payload></$payload>",
        category=ContextCategory.HTMLTag,
    ),
    Context(
        name="a.href",
        description="As an href attribute of an anchor",
        implementation="""<a href=$payload>Link</a>""",
        category=ContextCategory.HTMLAttributeHref,
    ),
    Context(
        name="area.href",
        description="As an href of the area tag",
        implementation="""<area href=$payload>Link</area>""",
        category=ContextCategory.HTMLAttributeHref,
    ),
    Context(
        name="link.href",
        description="As an href attribute of a link tag",
        implementation="""<head><link href=$payload /></head>""",
        category=ContextCategory.HTMLAttributeHref,
    ),
    Context(
        name="embed.src",
        description="As a src attribute of an embed tag",
        implementation="""<embed src=$payload />""",
        category=ContextCategory.HTMLAttributeSrc,
    ),
    Context(
        name="form.action",
        description="As an action attribute of a form",
        implementation="""<form action=$payload><button type=submit>Submit</button></form>""",
        category=ContextCategory.HTMLAttributeHref,
    ),
    Context(
        name="iframe.src",
        description="As a src attribute of an iframe",
        implementation="""<iframe src=$payload />""",
        category=ContextCategory.HTMLAttributeSrc,
    ),
    Context(
        name="iframe.srcdoc",
        description="As a srcdoc attribute of an iframe",
        implementation="""<iframe srcdoc=$payload />""",
        category=ContextCategory.HTMLAttributeSrc,
    ),
    Context(
        name="iframe.attribute",
        description="As a generic attribute of an iframe",
        implementation="""<iframe src="data:text/html, <h1>This is an iframe!</h1>" attribute=$payload />""",
        category=ContextCategory.HTMLAttributeSrc,
    ),
    Context(
        name="input.formaction",
        description="As a formaction attribute of an input",
        implementation="""<form><input value="Submit" type="submit" formaction=$payload /></form>""",
        category=ContextCategory.HTMLAttributeHref,
    ),
    Context(
        name="button.formaction",
        description="As a formaction attribute of an button",
        implementation="""<form><button formaction=$payload>Start</button></form>""",
        category=ContextCategory.HTMLAttributeHref,
    ),
    Context(
        name="meta.content",
        description="As a content attribute of a meta tag",
        implementation="""<meta content=$payload />""",
        category=ContextCategory.HTMLAttribute,
    ),
    Context(
        name="object.data",
        description="As a data attribute of an object tag",
        implementation="""<object data=$payload />""",
        category=ContextCategory.HTMLAttributeSrc,
    ),
    Context(
        name="textarea",
        description="Inside a textarea",
        implementation="""<textarea>$payload</textarea>""",
        category=ContextCategory.innerHTML,
    ),
    Context(
        name="textarea.value",
        description="As the value attribute of a textarea",
        implementation="""<textarea value=$payload>></textarea>""",
        category=ContextCategory.HTMLAttribute,
    ),
    Context(
        name="head",
        description="Inside the HTML head tag",
        implementation="<head>$payload</head>",
        category=ContextCategory.innerHTML,
    ),
    Context(
        name="head.title",
        description="Inside the HTML title",
        implementation="<head><title>$payload</title></head>",
        category=ContextCategory.innerHTML,
    ),
    Context(
        name="head.style",
        description="Inside a style tag in the HTML head",
        implementation="<head><style>$payload</style></head>",
        category=ContextCategory.innerHTML,
    ),
    Context(
        name="head.style.comment",
        description="Inside a CSS comment in a style tag in the HTML head",
        implementation="<head><style>/* $payload */</style></head>",
        category=ContextCategory.innerHTML,
    ),
    Context(
        name="noscript",
        description="In a noscript element",
        implementation="<noscript>$payload</noscript>",
        category=ContextCategory.innerHTML,
    ),
    Context(
        name="noembed",
        description="In a noembed element",
        implementation="<noembed>$payload</noembed>",
        category=ContextCategory.innerHTML,
    ),
    Context(
        name="select.option",
        description="As an option to a select element",
        implementation="<select><option>$payload</option></select>",
        category=ContextCategory.innerHTML,
    ),
    Context(
        name="frameset",
        description="Inside a frameset element",
        implementation="<frameset>$payload</frameset>",
        category=ContextCategory.innerHTML,
    ),
    Context(
        name="frameset.frame.src",
        description="As the src attribute of a frame element inside a frameset",
        implementation="""<frameset><frame src=$payload></frameset>""",
        category=ContextCategory.HTMLAttributeSrc,
    ),
    Context(
        name="template",
        description="Inside a template element",
        implementation="<template>$payload</template>",
        category=ContextCategory.innerHTML,
    ),
    Context(
        name="object.param.code",
        description="As a value to a code param inside an object element",
        implementation=("<object>"
                        """<param name="code" value=$payload />"""
                        "</object>"),
        category=ContextCategory.HTMLAttribute,
    ),
    Context(
        name="object.param.movie",
        description="As a value to a movie param inside an object element",
        implementation=("<object>"
                        """<param name="movie" value=$payload />"""
                        "</object>"),
        category=ContextCategory.HTMLAttribute,
    ),
    Context(
        name="object.param.src",
        description="As a value to a src param inside an object element",
        implementation=("<object>"
                        """<param name="src" value=$payload />"""
                        "</object>"),
        category=ContextCategory.HTMLAttribute,
    ),
    Context(
        name="object.param.url",
        description="As a value to a url param inside an object element",
        implementation=("<object>"
                        """<param name="url" value=$payload />"""
                        "</object>"),
        category=ContextCategory.HTMLAttribute,
    ),
    Context(
        name="svg.script.xlink-href",
        description="As an xlink:href attribute of a script inside an xlink-svg element",
        implementation=("""<svg xmlns:xlink="http://www.w3.org/1999/xlink">"""
                        """<script xlink:href=$payload></script>"""
                        "</svg>"),
        category=ContextCategory.HTMLAttributeHref,
    ),
    Context(
        name="svg.a.xlink-href",
        description="As an xlink:href attribute of an anchor inside an xlink-svg element",
        implementation=(
            """<svg xmlns:xlink="http://www.w3.org/1999/xlink" width="500" height="500">"""
            """<a xlink:href=$payload>Link</a>"""
            "</svg>"),
        category=ContextCategory.HTMLAttributeHref,
    ),
    Context(
        name="script.setInnerHTML",
        description="Inside a script tag as an assignment to an element's innerHTML",
        implementation=(
            "<div id='d'></div>"
            "<script>"
            """document.getElementById('d').innerHTML = $payload ;"""
            "</script>"),
        category=ContextCategory.JS,
    ),
] + event_contexts + angular_contexts

ClientContexts = {context.name: context for context in ClientContextsList}
ServerContexts = {context.name: context for context in ServerContextsList}
