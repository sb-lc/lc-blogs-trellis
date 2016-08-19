#!/bin/bash
#USAGE: sh wp-posts.sh /srv/www/lc-connect.co.uk/current/web/wp sage-timber-lc-connect

HOME_PAGE_ID=`sudo -u vagrant -i -- wp --path=$1 post create --porcelain --post_type=page --post_title='Home' --post_status='publish'`
SAMPLE_PAGE_ID=`sudo -u vagrant -i -- wp --path=$1 lc getPageByTitle 'Sample Page'`

if [ "$SAMPLE_PAGE_ID" > "0" ]; then
	sudo -u vagrant -i -- wp --path=$1 post delete $SAMPLE_PAGE_ID --force
fi

sudo -u vagrant -i -- wp --path=$1 lc emptyTrash
# sudo -u vagrant -i -- wp --path=$1 option update show_on_front page
# sudo -u vagrant -i -- wp --path=$1 option update page_on_front $HOME_PAGE_ID
# sudo -u vagrant -i -- wp --path=$1 post update $HOME_PAGE_ID --page_template='page-home.php'