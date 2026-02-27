FROM tomcat:8.5-jre8-alpine

ENV AXIS2_VERSION=1.8.2 \
    AXIS2_INSTALL_DIR=/usr/local/axis2 \
    AXIS2_SERVICES_DIR=/usr/local/axis2/WEB-INF/services

WORKDIR /tmp
COPY config/server.xml /usr/local/tomcat/conf/server.xml
COPY config/axis2.xml /usr/local/tomcat/conf/Catalina/localhost/axis2.xml
RUN mkdir ${AXIS2_INSTALL_DIR} && \
    cd ${AXIS2_INSTALL_DIR} && \
    wget https://dlcdn.apache.org/axis/axis2/java/core/${AXIS2_VERSION}/axis2-${AXIS2_VERSION}-war.zip && \
    unzip axis2-${AXIS2_VERSION}-war.zip && \
    unzip axis2.war && \
    rm -rf axis2-${AXIS2_VERSION}-war.zip axis2.war *.txt && \
    sed -i 's/password">axis2/password">securedpassword/g' /usr/local/axis2/WEB-INF/conf/axis2.xml
