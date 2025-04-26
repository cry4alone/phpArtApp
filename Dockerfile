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

RUN mkdir -p ./public/images/uploads
RUN chmod -R 775 ./public/images/uploads

# Установка Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Копирование пользовательского конфига Apache
COPY apache.conf /etc/apache2/sites-available/000-default.conf

# Открытие порта
EXPOSE 80
