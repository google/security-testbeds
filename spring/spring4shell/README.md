# Spring4Shell (CVE-2022-22965) Testbed

Sample Spring form using Tomcat as the server. The vulnerability appears to be only exploitable when packaged as a WAR file and served through a servlet container, such as Apache Tomcat.

## Deploy the testbed

### Vulnerable
The vulnerable test application uses:
- Spring Boot v2.6.3
- Spring Core v5.3.15

The application can be deployed using the following command:
```
docker compose up
```

### Safe
The safe test application uses:
- Spring Boot v2.7.0
- Spring Core v5.3.20

The application can be deployed using the following command:
```
docker compose -f docker-compose-safe.yml up
```

## Proof of concept
The following docker-packaged proof of concept can be used to verify if the application is vulnerable:
```
docker run --rm --net=host bobtheshoplifter/spring4shell-poc:latest --url "http://127.0.0.1:8080/spring-form/greeting"
```

## References

Testbeds and Proof of Concept are from [github.com/BobTheShoplifter/Spring4Shell-POC](https://github.com/BobTheShoplifter/Spring4Shell-POC/).