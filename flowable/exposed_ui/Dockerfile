FROM eclipse-temurin:21-jdk AS builder

# Copy the Flowable REST app libs for compilation classpath
COPY --from=flowable/flowable-rest /app/WEB-INF/lib /libs
COPY --from=flowable/flowable-rest /app/WEB-INF/classes /classes

# Copy our replacement SecurityConfiguration
COPY SecurityConfiguration.java /src/SecurityConfiguration.java

# Compile the replacement SecurityConfiguration against the app's classpath
RUN javac -cp "/libs/*:/classes" \
    -d /output \
    /src/SecurityConfiguration.java

FROM flowable/flowable-rest

# Replace the original SecurityConfiguration with our permit-all version
COPY --from=builder /output/org/flowable/rest/conf/SecurityConfiguration.class \
    /app/WEB-INF/classes/org/flowable/rest/conf/SecurityConfiguration.class
