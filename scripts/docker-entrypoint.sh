#!/bin/sh

set -eo pipefail
YAML=/yaml
PARAMFILE=/var/www/symfony/app/config/parameters.yml

if [ ! -f "/tania-setup.lock" ];
then
  echo "Setting up..."
  if [ ! -z $TANIA_MYSQL_HOST ]; then $YAML w -i $PARAMFILE parameters.database_host $TANIA_MYSQL_HOST; fi
  if [ ! -z $TANIA_MYSQL_PORT ]; then $YAML w -i $PARAMFILE parameters.database_port $TANIA_MYSQL_PORT; fi
  if [ ! -z $TANIA_MYSQL_NAME ]; then $YAML w -i $PARAMFILE parameters.database_name $TANIA_MYSQL_NAME; fi
  if [ ! -z $TANIA_MYSQL_USER ]; then $YAML w -i $PARAMFILE parameters.database_user $TANIA_MYSQL_USER; fi
  if [ ! -z $TANIA_MYSQL_PASSWORD ]; then $YAML w -i $PARAMFILE parameters.database_password $TANIA_MYSQL_PASSWORD; fi
fi

echo "Generated parameters:"
cat $PARAMFILE 

php bin/console --no-interaction doctrine:migrations:migrate

touch /tania-setup.lock

echo "Tania has been set up"

/usr/local/sbin/php-fpm


