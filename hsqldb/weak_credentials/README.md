# HyperSQL Weak Credentials Setup

1. On hsqldb_unsecured folder there is a Dockerfile that creates an instance with default HyperSQL default credentials

2. On hsqldb_secured folder there is a Dockerfile that creates an instance with a different password

3. UNSECURED: Run the docker build: `cd hsqldb_unsecured && docker build . -t hsqldb_unsecured && docker run -d -p 8080:9001 --name hsqldb_unsecured hsqldb_unsecured && cd ..`

4. Connect to it locally by using hsqldb.jar and sqltool.jar with command `java -cp hsqldb-2.7.2.jar:sqltool.jar org.hsqldb.cmdline.SqlTool --inlineRc=url=jdbc:hsqldb:hsql://localhost:8080/testdb,user=SA,password=`

5. SECURED: Run the docker build: `cd hsqldb_secured && docker build . -t hsqldb_secured && docker run -d -p 8081:9001 --name hsqldb_secured hsqldb_secured && cd ..`

6. Connect to it locally by using hsqldb.jar and sqltool.jar with command `java -cp hsqldb-2.7.2.jar:sqltool.jar org.hsqldb.cmdline.SqlTool --inlineRc=url=jdbc:hsqldb:hsql://localhost:8081/testdb,user=SA` and using password `securedpassword`

7. CLEAN-UP: Run the command `docker stop hsqldb_unsecured && docker rm hsqldb_unsecured && docker stop hsqldb_secured && docker rm hsqldb_secured`
