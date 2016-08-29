#!/bin/bash
#USAGE: sh wp-posts.sh /srv/www/lc-connect.co.uk/current/web/wp sage-timber-lc-connect

HOME_PAGE_ID=`sudo -u vagrant -i -- wp --path=$1 post create --porcelain --post_type=page --post_title='Home' --post_status='publish'`

sudo -u vagrant -i -- wp --path=$1 post delete $(wp post list --post_type=page --posts_per_page=1 --post_status=publish --pagename="sample-page" --field=ID --format=ids)

sudo -u vagrant -i -- wp --path=$1 option update show_on_front 'page'
sudo -u vagrant -i -- wp --path=$1 option update page_on_front $HOME_PAGE_ID
sudo -u vagrant -i -- wp --path=$1 post update $HOME_PAGE_ID --page_template='page-home.php'


#sudo -u vagrant -i -- wp --path=$1 lc emptyTrash
