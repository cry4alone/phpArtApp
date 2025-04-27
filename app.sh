#!/bin/bash

# Настройка прав доступа (выполняется от root)
UPLOAD_DIR="/var/www/html/public/images/uploads"

if [ ! -d "$UPLOAD_DIR" ]; then
    mkdir -p "$UPLOAD_DIR"
fi

chown -R www-data:www-data "$UPLOAD_DIR"
chmod -R 755 "$UPLOAD_DIR"

echo "Permissions for $UPLOAD_DIR have been set successfully."

a2enmod rewrite

git config --global --add safe.directory /var/www/html

# Переключаемся на пользователя www-data
su -c "composer install && php /var/www/html/app/conf/init_db.php && a2enmod rewrite && apache2-foreground" www-data