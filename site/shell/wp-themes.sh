#!/bin/bash
#USAGE: sh wp-themes.sh /srv/www/lc-connect.co.uk/current/web/wp sage-timber-lc-connect

sudo -u vagrant -i -- wp --path=$1 theme activate $2