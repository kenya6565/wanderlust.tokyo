FROM php:7.2-fpm
 
RUN apt-get update && apt-get install -y default-mysql-client libmcrypt-dev libcurl3-dev zip unzip \
    && pecl install mcrypt-1.0.2 \
    && docker-php-ext-install curl \
    && docker-php-ext-enable mcrypt \
    && docker-php-ext-install pdo_mysql \
    && curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer \
    && apt-get update && apt-get install -y git \
    && apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libmcrypt-dev \
        libpng-dev \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd exif
COPY php.ini /usr/local/etc/php
WORKDIR /app
