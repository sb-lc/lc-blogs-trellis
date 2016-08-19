#!/bin/bash

#USAGE: sh wp-plugins.sh /srv/www/lc-connect.co.uk/current/web/wp sage-timber-lc-connect
# sudo -u vagrant -i -- wp --path=/srv/www/lc-connect.co.uk/current/web/wp --skip-themes plugin activate timber-library

echo "WP_PATH : "$1
echo "THEME : "$2

#sudo -u vagrant -i -- wp --path=$1 plugin deactivate --all --color 

sudo -u vagrant -i -- wp --path=$1 plugin activate timber-library

sudo -u vagrant -i -- wp --path=$1 plugin activate CMB2-Date-Range-Field

sudo -u vagrant -i -- wp --path=$1 plugin activate disable-comments
sudo -u vagrant -i -- wp --path=$1 plugin activate duplicate-post
sudo -u vagrant -i -- wp --path=$1 plugin activate formidable
sudo -u vagrant -i -- wp --path=$1 plugin activate lc-ajax-loader
sudo -u vagrant -i -- wp --path=$1 plugin activate medusa-content-suite
sudo -u vagrant -i -- wp --path=$1 plugin activate open-graph-protocol-framework
sudo -u vagrant -i -- wp --path=$1 plugin activate paste-as-plain-text
sudo -u vagrant -i -- wp --path=$1 plugin activate wp-migrate-db-pro
sudo -u vagrant -i -- wp --path=$1 plugin activate wp-migrate-db-pro-cli
sudo -u vagrant -i -- wp --path=$1 plugin activate wp-migrate-db-pro-media-files
