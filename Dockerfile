FROM php:apache

# Установка зависимостей
RUN apt-get update && apt-get install -y \
    libpq-dev \
    zip \
    unzip \
    git \
    curl \
    gnupg \
    && docker-php-ext-install pdo_pgsql pgsql

# Установка Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Копирование пользовательского конфига Apache
COPY apache.conf /etc/apache2/sites-available/000-default.conf

COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

# Открытие порта
EXPOSE 80
ENTRYPOINT ["/entrypoint.sh"]