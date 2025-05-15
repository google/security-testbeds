# WordPress with exposed installation page

This directory contains the deployment configs for a WordPress application where
the installation page is exposed. The service listens on port `80`.

This config deploys the following services:

-   `pre-setup-wp`: the WordPress application.
-   `pre-setup-wp-mysql`: the MySql database for the WordPress application.

and the following storage:

-   `mysql-pv-claim`: File system required by MySql.
-   `pre-setup-wp-pv-claim`: File system required by WordPress.

Replace `${db_password}` with a password of your choice in wordpress.yaml