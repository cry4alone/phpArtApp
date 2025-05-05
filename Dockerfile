FROM php:apache

# Установка зависимостей
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    curl \
    gnupg \
    && docker-php-ext-install pdo_pgsql pgsql \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd

# Установка Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Копирование пользовательского конфига Apache
COPY apache.conf /etc/apache2/sites-available/000-default.conf

COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

# Открытие порта
EXPOSE 80
ENTRYPOINT ["/entrypoint.sh"]