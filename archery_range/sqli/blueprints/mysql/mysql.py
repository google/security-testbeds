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
import os

from flask import Blueprint
from flask import render_template
from flask import request
import pymysql
import pymysql.cursors
from custom_message_error import CustomMessageError
from test_case_decorator import TestCaseDecorator


test_cases = TestCaseDecorator("/sqli/mysql/")
mysql_blueprint = Blueprint("mysql_module", __name__)


@mysql_blueprint.route("/")
def index():
  return render_template(
      "index_database.html",
      test_cases=test_cases.get_test_cases(),
      database="MySQL")


def connect():
  return pymysql.connect(
      db=os.environ["MYSQL_DB"],
      user=os.environ["MYSQL_USER"],
      passwd=os.environ["MYSQL_PASSWORD"],
      host=os.environ["MYSQL_HOST"],
      cursorclass=pymysql.cursors.DictCursor)


def execute_query(query):
  """Execute database query."""
  conn, cur = None, None
  try:
    conn = connect()
    cur = conn.cursor()
    cur.execute(query)
    return list(cur.fetchall())
  finally:
    if cur is not None:
      cur.close()
    if conn is not None:
      conn.close()


def execute_query_with_error_message(query):
  """Execute database query and report errors to users."""
  conn, cur = None, None
  try:
    conn = connect()
    cur = conn.cursor()
    cur.execute(query)
    return list(cur.fetchall())
  except pymysql.Error as err:
    error_message = "Executed: [" + query + "] Error: [" + str(err) + "]"
    raise CustomMessageError(404, error_message) from err
  finally:
    if cur is not None:
      cur.close()
    if conn is not None:
      conn.close()


@mysql_blueprint.route("/items/id_error")
@test_cases.add_test_case("/items/id_error?id=1",
                          "Injection into unquoted value with error message")
def items_with_error_message():
  query = f"SELECT id, name, description, price, category FROM items WHERE id={request.args.get('id', '1')} ORDER BY 1 ASC"
  return render_template(
      "items.html", db_items=execute_query_with_error_message(query))


@mysql_blueprint.route("/items/id")
@test_cases.add_test_case("/items/id?id=1", "Injection into unquoted value")
def items():
  query = f"SELECT id, name, description, price, category FROM items WHERE id={request.args.get('id', '1')} ORDER BY 1 ASC"
  return render_template("items.html", db_items=execute_query(query))


@mysql_blueprint.route("/items/name/single")
@test_cases.add_test_case("/items/name/single?name=badger",
                          "Injection into single quoted value")
def name_single_quoted_items():
  query = f"SELECT id, name, description, price, category FROM items WHERE name LIKE '%{request.args.get('name', 'badger')}%' ORDER BY 1 ASC"
  return render_template("items.html", db_items=execute_query(query))


@mysql_blueprint.route("/items/name/single_error")
@test_cases.add_test_case("/items/name/single_error?name=badger",
                          "Injection into single quoted value with error info")
def name_single_quoted_items_with_error_message():
  query = f"SELECT id, name, description, price, category FROM items WHERE name LIKE '%{request.args.get('name', 'badger')}%' ORDER BY 1 ASC"
  return render_template(
      "items.html", db_items=execute_query_with_error_message(query))


@mysql_blueprint.route("/items/name/double")
@test_cases.add_test_case("/items/name/double?name=badger",
                          "Injection into double quoted value")
def name_double_quoted_items():
  query = f"SELECT id, name, description, price, category FROM items WHERE name LIKE \"%{request.args.get('name', 'badger')}%\" ORDER BY 1 ASC"
  return render_template("items.html", db_items=execute_query(query))


@mysql_blueprint.route("/items/name/double_error")
@test_cases.add_test_case("/items/name/double_error?name=badger",
                          "Injection into double quoted value with error info")
def name_double_quoted_items_with_error_message():
  query = f"SELECT id, name, description, price, category FROM items WHERE name LIKE \"%{request.args.get('name', 'badger')}%\" ORDER BY 1 ASC"
  return render_template(
      "items.html", db_items=execute_query_with_error_message(query))


@mysql_blueprint.route("/items/group")
@test_cases.add_test_case("/items/group?group=id",
                          "Injection into the value of GROUP BY")
def group_items():
  query = f"SELECT id, name, description, price, category FROM items  GROUP BY {request.args.get('group', 'id')} ORDER BY 1 ASC"
  return render_template("items.html", db_items=execute_query(query))


@mysql_blueprint.route("/items/limit")
@test_cases.add_test_case("/items/limit?limit=10",
                          "Injection into the value of LIMIT")
def limit_items():
  query = f"SELECT id, name, description, price, category FROM items ORDER BY 1 ASC LIMIT {request.args.get('limit', '10')}"
  # TODO: Investigate whether this case still makes sense.
  return render_template("items.html", db_items=execute_query(query))


@mysql_blueprint.route("/items/column")
@test_cases.add_test_case("/items/column?column=name&value=badger",
                          "Injection into column in WHERE unquoted")
def column_items():
  query = f"SELECT id, name, description, price, category FROM items WHERE {request.args.get('column', 'name')} LIKE '%{request.args.get('value', 'badger')}%' ORDER BY 1 ASC"
  return render_template("items.html", db_items=execute_query(query))


@mysql_blueprint.route("/items/column/quoted")
@test_cases.add_test_case("/items/column/quoted?column=name&value=badger",
                          "Injection into column in WHERE quoted")
def column_quoted_items():
  query = f"SELECT id, name, description, price, category FROM items WHERE `{request.args.get('column', 'name')}` LIKE '%{request.args.get('value', 'badger')}%' ORDER BY 1 ASC"
  return render_template("items.html", db_items=execute_query(query))
