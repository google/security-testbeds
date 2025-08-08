import json, pprint, requests, textwrap
host = 'http://localhost:8998'

r = requests.delete(host + '/sessions/1')
pprint.pprint(r.json())
