FROM php:apache

# Установка зависимостей
RUN apt-get update && apt-get install -y \
    libpq-dev \
    curl \
    gnupg \
    && docker-php-ext-install pdo_pgsql pgsql

# Копирование пользовательского конфигурационного файла Apache 
COPY apache.conf /etc/apache2/sites-available/000-default.conf

# Копирование файлов проекта
COPY . /var/www/html/

# Открытие порта
EXPOSE 80
