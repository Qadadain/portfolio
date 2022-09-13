#!/bin/sh

# update application cache
# php artisan optimize

# start the application
chmod -R 777 /var/www/html/var/
php-fpm -D && nginx -g "daemon off;"
