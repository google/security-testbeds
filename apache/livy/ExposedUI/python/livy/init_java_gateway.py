import json, pprint, requests, textwrap
host = 'http://localhost:8998'
headers = {'Content-Type': 'application/json'}
statements_url = host + '/sessions/1/statements'

data = {
  'code': textwrap.dedent("""
    # from https://stackoverflow.com/questions/65713299/javapackage-object-is-not-callable-error-executing-explain-in-pyspark-3-0
    # from https://github.com/apache/spark/blob/87bf6b0ea4ca0618c8604895d05037edce8b7cb0/python/pyspark/java_gateway.py#L153

    from py4j.java_gateway import java_import
    java_import(spark._sc._jvm, "org.apache.spark.SparkConf")
    java_import(spark._sc._jvm, "org.apache.spark.api.java.*")
    java_import(spark._sc._jvm, "org.apache.spark.api.python.*")
    java_import(spark._sc._jvm, "org.apache.spark.ml.python.*")
    java_import(spark._sc._jvm, "org.apache.spark.mllib.api.python.*")
    java_import(spark._sc._jvm, "org.apache.spark.resource.*")
    
    java_import(spark._sc._jvm, "org.apache.spark.sql.*")
    java_import(spark._sc._jvm, "org.apache.spark.sql.api.python.*")
    java_import(spark._sc._jvm, "org.apache.spark.sql.hive.*")
    """)
}

r = requests.post(statements_url, data=json.dumps(data), headers=headers)
pprint.pprint(r.json())
