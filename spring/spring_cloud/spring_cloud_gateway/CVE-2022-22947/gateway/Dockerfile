FROM maven:3.8.6-openjdk-11 AS build

ARG SCG_VERSION
WORKDIR /app
COPY . .

# Replace version dynamically
RUN sed -i "s/SCG_VERSION_PLACEHOLDER/${SCG_VERSION}/g" pom.xml

RUN mvn clean package -DskipTests

FROM eclipse-temurin:11-jre-jammy
COPY --from=build /app/target/demo-0.0.1-SNAPSHOT.jar app.jar

ENTRYPOINT ["java","-jar","/app.jar"]