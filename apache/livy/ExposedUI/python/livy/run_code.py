import json, pprint, requests, textwrap
host = 'http://localhost:8998'
headers = {'Content-Type': 'application/json'}
statements_url = host + '/sessions/1/statements'

data = {
  'code': textwrap.dedent("""
    df = spark.createDataFrame([{"id": 1, "name": "Mounir"}])

    df.show()
    """)
}

r = requests.post(statements_url, data=json.dumps(data), headers=headers)
pprint.pprint(r.json())
