FROM php:apache

RUN apt-get update && apt-get install -y \
    libpq-dev \
    curl \
    gnupg \
    && docker-php-ext-install pdo_pgsql pgsql

EXPOSE 80