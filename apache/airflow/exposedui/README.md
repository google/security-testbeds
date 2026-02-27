# Initialize
run `docker compose up` to start both vulnerable and safe airflow instances.

# vulnerble airflow instance
1. You can now navigate to `http://172.20.0.2:8080/home`. Notice that no authorization is needed to access the panel.
2. Navigate to `http://localhost:8080/connection/add`. From there, you can select the HTTP connection type.
3. Notice that the Test button is enabled. With it, you can test the out-of-band interaction.

You can find the reference here: [https://airflow.apache.org/docs/apache-airflow-providers-fab/stable/auth-manager/webserver-authentication.html#webserver-authentication](https://airflow.apache.org/docs/apache-airflow-providers-fab/stable/auth-manager/webserver-authentication.html#webserver-authentication)

# safe airflow instance
Unlike the unsafe setup, here the `AUTH_ROLE_PUBLIC = 'Admin'` is removed from the `config/webserver_config.py` file. Moreover, we don't export the `AIRFLOW__CORE__TEST_CONNECTION=Enabled` environment variable.
1. You can now navigate to [http://172.20.0.3:8080/home](http://localhost:8080/home).
2. Notice that, this time, you need to be authenticated to hit the endpoint. As a result of this, you will be redirect to the `/login` page.
