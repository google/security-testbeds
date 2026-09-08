#!/bin/sh

/usr/local/bin/php /var/www/html/laravel/laravel-app/artisan serve --host=0.0.0.0 > /logs/$(date +%s).log 2>&1 &
/usr/local/bin/php /var/www/html/laravel/laravel-app/artisan pail -vv > /logs/$(date +%s).log 2>&1 &
socat - TCP:127.0.0.1:8000,forever
