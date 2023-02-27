FROM php:8.1.16-apache

WORKDIR /var/www/html

RUN apt-get update && apt-get install -y libmariadb-dev \
    git \
    curl \
    zip \
    unzip

RUN docker-php-ext-install mysqli

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer