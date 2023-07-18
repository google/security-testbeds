import os

from flask import Blueprint
from flask import render_template
from flask import request
from google.cloud import spanner

from custom_message_error import CustomMessageError
from test_case_decorator import TestCaseDecorator

test_cases = TestCaseDecorator("/sqli/googlesql/")
googlesql_blueprint = Blueprint("googlesql_module", __name__)

instance_id = os.environ.get(
    "SPANNER_INSTANCE_ID", "tfgen-spanid-20230712060131434"
)
database_id = "archery_range"


@googlesql_blueprint.route("/")
def index():
  return render_template(
      "index_database.html",
      test_cases=test_cases.get_test_cases(),
      database="GoogleSQL",
  )


def execute_query(transaction, query):
  results = transaction.execute_sql(query)
  res = [
      {
          "id": row[0],
          "name": row[1],
          "description": row[2],
          "price": row[3],
          "category": row[4],
      }
      for row in results
  ]
  return res


def read_data(query_statement):
  try:
    spanner_client = spanner.Client()
    instance = spanner_client.instance(instance_id)
    database = instance.database(database_id)
    return database.run_in_transaction(execute_query, query=query_statement)
  except Exception as e:
    error_message = (
        "Executed: [" + query_statement + "] Error: [" + str(e) + "]"
    )
    raise CustomMessageError(404, error_message) from e


@googlesql_blueprint.route("/items/id")
@test_cases.add_test_case("/items/id?id=1", "Injection into unquoted value")
def items():
  query = (
      "SELECT id,name,description,price,category FROM items WHERE"
      f" id={request.args.get('id', '1')} ORDER BY 1 ASC"
  )
  return render_template("items.html", db_items=read_data(query))


@googlesql_blueprint.route("/items/name/single")
@test_cases.add_test_case(
    "/items/name/single?name=badger", "Injection into single quoted value"
)
def name_single_quoted_items():
  query = (
      "SELECT id, name, description, price, category FROM items WHERE name"
      f" LIKE '%{request.args.get('name', 'badger')}%' ORDER BY 1 ASC"
  )
  return render_template("items.html", db_items=read_data(query))


@googlesql_blueprint.route("/items/name/double")
@test_cases.add_test_case(
    "/items/name/double?name=badger", "Injection into double quoted value"
)
def name_double_quoted_items():
  query = (
      "SELECT id, name, description, price, category FROM items WHERE name"
      f" LIKE \"%{request.args.get('name', 'badger')}%\" ORDER BY 1 ASC"
  )
  return render_template("items.html", db_items=read_data(query))


@googlesql_blueprint.route("/items/group")
@test_cases.add_test_case(
    "/items/group?group=id", "Injection into the value of GROUP BY"
)
def group_items():
  query = (
      "SELECT id, name, description, price, category FROM items GROUP BY"
      f" {request.args.get('group', 'id')} ORDER BY 1 ASC"
  )
  return render_template("items.html", db_items=read_data(query))


@googlesql_blueprint.route("/items/limit")
@test_cases.add_test_case(
    "/items/limit?limit=10", "Injection into the value of LIMIT"
)
def limit_items():
  query = (
      "SELECT id, name, description, price, category FROM items ORDER BY 1 ASC"
      f" LIMIT {request.args.get('limit', '10')}"
  )
  return render_template("items.html", db_items=read_data(query))


@googlesql_blueprint.route("/items/column")
@test_cases.add_test_case(
    "/items/column?column=name&value=badger",
    "Injection into column in WHERE unquoted",
)
def column_items():
  query = (
      "SELECT id, name, description, price, category FROM items WHERE"
      f" {request.args.get('column', 'name')} LIKE"
      f" '%{request.args.get('value', 'badger')}%' ORDER BY 1 ASC"
  )
  return render_template("items.html", db_items=read_data(query))


@googlesql_blueprint.route("/items/column/quoted")
@test_cases.add_test_case(
    "/items/column/quoted?column=name&value=badger",
    "Injection into column in WHERE quoted",
)
def column_quoted_items():
  query = (
      "SELECT id, name, description, price, category FROM items WHERE"
      f" `{request.args.get('column', 'name')}` LIKE"
      f" '%{request.args.get('value', 'badger')}%' ORDER BY 1 ASC"
  )
  return render_template("items.html", db_items=read_data(query))
