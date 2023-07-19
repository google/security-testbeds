import os
from google.cloud import spanner
import csv,ast
from google3.pyglib import resources
OPERATION_TIMEOUT_SECONDS = 200

instance_id = os.environ.get(
    "SPANNER_INSTANCE_ID", "tfgen-spanid-20230712060131434"
)
database_id = "archery_range"

def get_data_from_csv(filename):
  filepath = resources.GetResourceFilename("google3/third_party/archery_range/sqli/sqli_server/googlesql_database/csv_files/"+filename)
  data = []
  with open(filepath,'r') as csvfile:
    for row in csv.reader(csvfile,quotechar='"'):
      actual_row = []
      for entry in row:
        try:
          actual_row.append(ast.literal_eval(str(entry)))
        except:
          actual_row.append(str(entry))
      data.append(tuple(actual_row))
  return data
#TODO : Rollback the Drop statements once the schema of tables are updated
def build_db(database):
  operation = database.update_ddl(
      ddl_statements=[
          """DROP TABLE IF EXISTS `users`""",
          """DROP TABLE IF EXISTS `items`""",
          """DROP TABLE IF EXISTS `carts`""",
          """DROP TABLE IF EXISTS `cartitems`""",
          """ CREATE TABLE IF NOT EXISTS `users` (`username` STRING(1024) NOT NULL,`color` STRING(1024) NOT NULL,`email` STRING(1024) NOT NULL ) PRIMARY KEY (`username`) """,
          """ CREATE TABLE IF NOT EXISTS `items` (`id` INT64 NOT NULL, `name` STRING(1024) NOT NULL, `description` STRING(1024) NOT NULL, `price` FLOAT64 NOT NULL, `category` STRING(1024), `is_available` BOOL NOT NULL ) PRIMARY KEY(`id`) """,
          """ CREATE TABLE IF NOT EXISTS `carts` (`id` INT64 NOT NULL, `username` STRING(1024) NOT NULL) PRIMARY KEY (`id`) """,
          """ CREATE TABLE IF NOT EXISTS `cartitems` (`id` INT64 NOT NULL, `item_id` INT64 NOT NULL, `quantity` INT64 NOT NULL, `cart_id` INT64 NOT NULL) PRIMARY KEY(`id`) """,
      ],
  )
  operation.result(OPERATION_TIMEOUT_SECONDS)

def insert_data(database):
  with database.batch() as batch:
    batch.insert_or_update(
        table = "users",
        columns = ("username","color","email"),
        values = get_data_from_csv("users.csv"),
    )

    batch.insert_or_update(
        table = "items",
        columns = ("id","name","description","price","category","is_available"),
        values = get_data_from_csv("items.csv")
    )

    batch.insert_or_update(
        table = "carts",
        columns = ("id","username"),
        values = get_data_from_csv("carts.csv")
    )

    batch.insert_or_update(
        table = "cartitems",
        columns = ("id","item_id","quantity","cart_id"),
        values = get_data_from_csv("cartitems.csv")
    )

def initialize_googlesql_db():
  try:
    spanner_client = spanner.Client()
    instance = spanner_client.instance(instance_id)
    database = instance.database(database_id)
    build_db(database)
    insert_data(database)
    print("db_init script passed")
  except Exception as e:
    print("db_init script failed"+ "\n" + "Error: " + str(e))
