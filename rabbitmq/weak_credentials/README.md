# RabbitMQ Management Portal

## Setup

1. `docker build -t rabbitmq .`
2. `docker run -d -p 8081:15671 8082:15672 rabbitmq`

It's important to notice that currently nmap doesn't scan as default the port 15672 where normally is running the management plugin, so in for the sake of testing we are going to map it to a different port
