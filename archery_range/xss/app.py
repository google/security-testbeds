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
import itertools
import flask
from string import Template
from enum import Enum
from typing import Tuple, List, Dict, Union

from components.sink import ServerSinks, ClientSinks, Sink
from components.source import ServerSources, ClientSources, Source, ComplexSource
from components.processor import none_processor, ServerProcessors, ClientProcessors, Processor
from components.context import body_context, script_context, ServerContexts, ClientContexts, Context, ContextCategory
from components.constants import APP_PORT, COOKIE_KEY, CLIENT_STORAGE_KEY
app = flask.Flask(__name__)
xss_server = flask.Blueprint('xss', __name__)

class XSSTestEnv(Enum):
  """Enum specyfing the environment of the test.

  Values map to the Flask blueprint handler of the specific environment.
  In templating, they are used with url_for() to generate lists of URLs linking
  to the correct handler for the tests' environment.
  """
  CLIENT = 'xss.handle_client_side'
  SERVER = 'xss.handle_server_side'


@app.after_request
def optionally_set_cookie(response):
  """Flask after request middleware to set a cookie for cookie sources."""
  if 'cookie' in flask.request.args.get(
      'source', '') and not flask.request.cookies.get(COOKIE_KEY, None):
    response.set_cookie(COOKIE_KEY, '1')
  return response


@app.after_request
def optionally_set_client_storage(response):
  """Flask middleware to set client storage for local storage sources."""
  if 'localStorage' in flask.request.args.get('source', ''):
    body = response.get_data()
    body += ("""<script>"""
             f"""if(!localStorage.getItem("{CLIENT_STORAGE_KEY}")"""
             f"""localStorage.setItem("{CLIENT_STORAGE_KEY}", "1");"""
             """</script>""").encode()
    response.set_data(body)
  elif 'sessionStorage' in flask.request.args.get('source', ''):
    body = response.get_data()
    body += ("""<script>"""
             f"""if(!sessionStorage.getItem("{CLIENT_STORAGE_KEY}")"""
             f"""sessionStorage.setItem("{CLIENT_STORAGE_KEY}", "1");"""
             """</script>""").encode()
    response.set_data(body)
  return response


def _get_libs(
    test_env: XSSTestEnv
) -> Tuple[Dict[str, Union[Source, ComplexSource]], Dict[str, Processor], Dict[
    str, Sink], Dict[str, Context]]:
  """Return the appropriate component libraries for the test environment."""
  sources_lib = ClientSources if test_env is XSSTestEnv.CLIENT else ServerSources
  sinks_lib = ClientSinks if test_env is XSSTestEnv.CLIENT else ServerSinks
  processors_lib = ClientProcessors if test_env is XSSTestEnv.CLIENT else ServerProcessors
  contexts_lib = ClientContexts if test_env is XSSTestEnv.CLIENT else ServerContexts

  return sources_lib, processors_lib, sinks_lib, contexts_lib


def _get_components(
    test_env: XSSTestEnv) -> Tuple[Source, List[Processor], Sink, Context]:
  """Lookup components from request arguments.

  If the components are missing or not defined in the particular test
  environment's list,
  the function will abort the response and reply with an error code.

  Args:
    test_env: The test environment specified by the enum.

  Returns:
    Tuple of
      source: The Source object taken from the library of sources for the
        environment
      processors: A list of Processor object taken from the library of
        processors for the environment
      sink: The Sink object taken from the library of sinks for the environment
      context: The Context object taken from the library of context for the
        environment
  """
  arg_source = flask.request.args.get('source', None)
  arg_sink = flask.request.args.get('sink', None)
  arg_processor = flask.request.args.getlist('processor')
  arg_context = flask.request.args.get('context', None)

  if arg_source is None or arg_sink is None:
    flask.abort(
        400,
        'Parameters source and sink must be specified: for instance, append ?source=location.hash&sink=eval to the request.'
    )

  sources_lib, processors_lib, sinks_lib, contexts_lib = _get_libs(
      test_env=test_env)

  if arg_source not in sources_lib:
    flask.abort(
        404, 'Source not found. Check the source code for available sources.')
  else:
    source = sources_lib[arg_source]
  if arg_sink not in sinks_lib:
    flask.abort(404,
                'Sink not found. Check the source code for available sinks.')
  else:
    sink = sinks_lib[arg_sink]

  processors = []
  if arg_processor:
    for processor in arg_processor:
      if processor not in processors_lib:
        flask.abort(
            404,
            f'Processor "{processor}" not found. Check the source code for available processors.'
        )
      else:
        # Get the processor or use default processor
        # Default processor just returns the payload unprocessed
        processors.append(processors_lib.get(processor, none_processor))
  if arg_context and arg_context not in contexts_lib:
    flask.abort(
        404, 'Context not found. Check the source code for available contexts.')
  else:
    # Get the context or use default context
    # Default context for server-side is the body,
    # for client-side it is inside a script tag
    context = contexts_lib.get(
        arg_context,
        body_context if test_env is XSSTestEnv.SERVER else script_context)

  return source, processors, sink, context


def _build_xss_test(test_env: XSSTestEnv) -> str:
  """Construct the XSS test from request arguments depending on the test environment.

  The test environment can be server-side or client-side as per the XSSTestEnv
  enum.

  Gets component from helper method.
  The method uses the following Flask request arguments:
    - source
    - sink
    - processor
    - context

  Through templating this method then builds the XSS test and a description.

  Args:
    test_env: The test environment specified by the enum.

  Returns:
    An HTML string containing the XSS test.
  """

  source, processors, sink, context = _get_components(test_env=test_env)

  source_implemented = source.make_implementation(flask_request=flask.request)

  processed = none_processor.make_implementation(payload=source_implemented)
  for processor in processors:
    processed = processor.make_implementation(payload=processed)

  sink_implemented = Template(sink.implementation)
  context_implemented = Template(
      context.make_implementation(flask_request=flask.request))

  # Make xss
  sinked = sink_implemented.substitute(payload=processed)
  xss = context_implemented.substitute(payload=sinked)

  # Make description
  description = (
      f'<p>Source: {source.description}</p>'
      f"""<p>Processors: {" ".join([p.description for p in processors])}</p>"""
      f'<p>Sink: {sink.description}</p>'
      f'<p>Context: {context.description}</p>')
  doc = xss + '<br>' + description
  return doc


def _list_links_available_tests(source_name: str,
                                test_env: XSSTestEnv) -> Dict[str, str]:
  """Generate a list of available tests for a source.

  Args
    source_name: The name of the source to use as base for generating the tests.
    test_env: The test environment.

  Returns:
    links: Dict of generated links with names as their keys

  """
  sources_lib, processors_lib, sinks_lib, contexts_lib = _get_libs(
      test_env=test_env)
  source = sources_lib.get(source_name, None)
  links = {}
  if not source:
    flask.abort(
        404, 'Source not found. Check the source code for available sources.')
    return links
  for source, context, sink in itertools.product([source],
                                                 contexts_lib.values(),
                                                 sinks_lib.values()):
    if sink.supported_context is (not context.category and
                                  not ContextCategory.ALL):
      continue
    proc_chain = ''
    for p in source.suggested_processors:
      proc_chain += f'&processor={p}'
    name = f'{source.name} -> {proc_chain} -> {sink.name} in {context.name}'
    link = flask.url_for(
        test_env.value
    ) + f'?source={source.name}&sink={sink.name}{proc_chain}&context={context.name}'
    links[name] = link
  return links


@xss_server.route('/client-side', defaults={'p': ''}, methods=['GET', 'POST'])
@xss_server.route('/client-side/<p>', methods=['GET', 'POST'])
def handle_client_side(p):
  """Handle client-side XSS tests.

  Catches /client-side and /client-side/*.

  Args:
    p: Path parameter, empty string by default.
  URL arguments to control the test:
    source: Selects source from the dict defined in components.source
    sink: Selects sink from the dict defined in components.sink
    processor: Selects the processor from the dict defined in
    components.processor (Optional; default: no processor)

  Returns:
    A HTML document containing the XSS test.
  """

  if flask.request.args.get('source') and not flask.request.args.get('sink'):
    # solely source arg set, build a list of available tests for the source
    generated_links = _list_links_available_tests(
        flask.request.args.get('source'), XSSTestEnv.CLIENT)
    return flask.render_template(
        'source.html',
        list_name='Client Side XSS',
        links=generated_links,
        cookie_key=COOKIE_KEY,
        storage_key=CLIENT_STORAGE_KEY), 200
  else:
    # build and serve xss
    xss = _build_xss_test(XSSTestEnv.CLIENT)
    return xss


@xss_server.route('/server-side', defaults={'p': ''}, methods=['GET', 'POST'])
@xss_server.route('/server-side/<p>', methods=['GET', 'POST'])
def handle_server_side(p):
  """Handle server-side XSS tests.

  Catches /server-side and /server-side/*.

  Args:
    p: Path parameter, empty string by default.
  URL arguments to control the test:
     source: Selects source from the dict defined in components.source
     sink: Selects sink from the dict defined in components.sink
     processor: Selects the processor from the dict defined in
     components.processor (Optional; default: no processor)
     context: Selects the context from the dict defined in components.context

  Returns:
    A HTML document containing the XSS test.
  """
  if flask.request.args.get('source') and not flask.request.args.get('sink'):
    # solely source arg set, build a list of available tests for the source
    generated_links = _list_links_available_tests(
        source_name=flask.request.args.get('source'),
        test_env=XSSTestEnv.SERVER)
    return flask.render_template(
        'source.html',
        list_name='Server Side XSS',
        links=generated_links,
        cookie_key=COOKIE_KEY,
        storage_key=CLIENT_STORAGE_KEY), 200
  else:
    xss = _build_xss_test(XSSTestEnv.SERVER)
    return xss


@xss_server.route('/')
def xss_index():
  """Serve a list of interesting tests and the health check of status code 200."""
  return flask.render_template(
      'index.html',
      client_sources=ClientSources,
      server_sources=ServerSources,
      cookie_key=COOKIE_KEY,
      storage_key=CLIENT_STORAGE_KEY), 200


@app.route('/')
def index():
  """Return a health check with status code 200."""
  return 'XSS testbed is running!', 200


app.register_blueprint(xss_server, url_prefix='/xss')

if __name__ == '__main__':
  app.run(host='0.0.0.0', port=APP_PORT)
