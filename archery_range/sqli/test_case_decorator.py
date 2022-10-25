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
import collections

TestCase = collections.namedtuple('TestCase', ['url', 'description'])


class TestCaseDecorator:
  """An object containing all test cases that make up the test suite for a specific database system.

  Exposes its functionality via the decorator pattern.

  Attributes:
    url_prefix: The path prefix which hosts all test cases for the given
      database system.
    test_cases: The collected test cases containing the url and pointers to
      where injected values are being used in the query.
  """

  def __init__(self, url_prefix: str):
    if not url_prefix.startswith('/'):
      raise ValueError('The url_prefix must start with a /.')

    self.url_prefix = url_prefix.rstrip('/')
    self.test_cases = list()

  def add_test_case(self, relative_url: str, description: str):
    """Adds a testcase to the internal state.

    Expands the relative URL with the prefix, matching the routes configured via
    the Flask blueprints. Stores the expanded URL together with the description
    and returns the identity function as decorator.

    Args:
      relative_url: the route to the testcase in the blueprint, including query
        parameters with default values
      description: A description where the provided values will be used in the
        query.

    Returns:
      The identity function
    """
    if not relative_url.startswith('/'):
      raise ValueError(
          'The relative_url provided to the decorator must start with a /.')
    self.test_cases.append(
        TestCase(self.url_prefix + relative_url, description))

    def inner(func):
      return func

    return inner

  def get_test_cases(self):
    return self.test_cases
