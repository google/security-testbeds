import pandas as pd

from pyspark.sql import SparkSession

app_name = "simple-app-pandas"

spark = SparkSession.builder.appName(app_name).getOrCreate()

# Creating a DataFrame from a dictionary
data = {
    'Name': ['Alice', 'Bob', 'Charlie'],
    'Age': [25, 30, 35],
    'City': ['New York', 'Los Angeles', 'Chicago']
}

df = pd.DataFrame(data)
print(df)

spark.stop()

