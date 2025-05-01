#!/bin/bash
set -e
set -x

if [ ! -d /var/www/html/public/images/uploads ]; then
    mkdir -p /var/www/html/public/images/uploads
fi

chown -R www-data:www-data /var/www/html/public/images/uploads
chmod -R 775 /var/www/html/public/images/uploads

composer install
php /var/www/html/app/conf/init_db.php
a2enmod rewrite

exec apache2-foreground