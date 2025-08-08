import json, pprint, requests, textwrap
host = 'http://localhost:8998'
headers = {'Content-Type': 'application/json'}
statements_url = host + '/sessions/1/statements'

external_python_file = './src/external_file.py'

with open(external_python_file, 'r') as file:
    pyspark_code = file.read()

data = {
        'code': pyspark_code
}

r = requests.post(statements_url, data=json.dumps(data), headers=headers)
pprint.pprint(r.json())
