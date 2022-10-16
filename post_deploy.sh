#!/bin/sh

# update application cache
# php artisan optimize

# start the application
chown -R www-data /var/www/html/var/
chmod -R 600 /var/www/html/var/

chown -R www-data /var/www/html/public/user/
chmod -R 600 /var/www/html/public/user/
php-fpm -D && nginx -g "daemon off;"
