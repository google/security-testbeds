# from https://livy.apache.org/examples/

# requires pip install requests
import json, pprint, requests, textwrap
host = 'http://localhost:8998'
headers = {'Content-Type': 'application/json'}

data = {'kind': 'pyspark', 'name': 'test pyspark session from python code', 'proxyUser': 'Mounir', 'executorMemory': '2g'}

r = requests.post(host + '/sessions', data=json.dumps(data), headers=headers)
pprint.pprint(r.json())
