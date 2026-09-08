FROM openjdk:11-jre-slim

# Install curl
RUN apt-get update && apt-get install -y curl --no-install-recommends && rm -rf /var/lib/apt/lists/*

# Set environment variables
ENV HSQLDB_VERSION=2.7.2
ENV HSQLDB_HOME=/opt/hsqldb
ENV PATH="${HSQLDB_HOME}:${PATH}"

# Download and set up HSQLDB
RUN mkdir -p ${HSQLDB_HOME} \
    && curl -L -o ${HSQLDB_HOME}/hsqldb.jar https://repo1.maven.org/maven2/org/hsqldb/hsqldb/${HSQLDB_VERSION}/hsqldb-${HSQLDB_VERSION}.jar

# Expose HSQLDB port
EXPOSE 9001

# Command to run HSQLDB server
CMD ["java", "-cp", "/opt/hsqldb/hsqldb.jar", "org.hsqldb.server.Server", "--database.0", "file:/opt/hsqldb/testdb", "--dbname.0", "testdb"]
