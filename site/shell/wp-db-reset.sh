#!/bin/bash

#USAGE: sh wp-db-reset.sh /srv/www/lc-connect.co.uk/current/web/wp

echo "WP_PATH : "$1
echo "THEME : "$2

sudo -u vagrant -i -- wp --path=$1 db reset --yes