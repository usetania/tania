#!/bin/sh
#cp -a tania/app/config/parameters.yml.dist tania/app/config/paramaters.yml
COMPOSER_ALLOW_SUPERUSER=1 composer install
chown -R www-data:www-data /var/www/symfony
