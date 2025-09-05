# Setup Apache Livy with Docker Compose

```bash
docker compose build spark-master
docker compose up
```
# Access the Livy UI and execute PySpark code
```bash
curl -X POST -H "Content-Type: application/json" -d '{"kind":"pyspark"}' http://localhost:8998/sessions
# {"id":6,"name":null,"appId":null,"owner":null,"proxyUser":null,"state":"starting","kind":"pyspark","appInfo":{"driverLogUrl":null,"sparkUiUrl":null},"log":["stdout: ","\nstderr: "],"ttl":null,"driverMemory":null,"driverCores":0,"executorMemory":null,"executorCores":0,"conf":{},"archives":[],"files":[],"heartbeatTimeoutInSecond":0,"jars":[],"numExecutors":0,"pyFiles":[],"queue":null}

# replace id from last response with $id
curl -X POST -H "Content-Type: application/json" -d '{"code":"import os\nprint(os.getcwd())"}' http://localhost:8998/sessions/$id/statements
# "java.lang.IllegalStateException: Session is in state starting"
#  wait 30sec
# {"id":0,"code":"import os\nprint(os.getcwd())","state":"waiting","output":null,"progress":0.0,"started":0,"completed":0}

# replace id from last reseponse with #statements_id
curl http://127.0.0.1:8998/sessions/$id/statements/$statements_id
# output.data is the stdout
# {"id":0,"code":"import os\nprint(os.getcwd())","state":"available","output":{"status":"ok","execution_count":0,"data":{"text/plain":"/opt"}},"progress":1.0,"started":1754515902001,"completed":1754515902003}
```