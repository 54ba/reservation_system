ARG PHP_VERSION="8.1"

FROM php:${PHP_VERSION}-fpm

USER root

COPY docker-php-entrypoint   /usr/local/bin/
COPY docker-php-entrypoint-dev   /usr/local/bin/


WORKDIR /var/www/html


# install necessary packages

RUN apt-get update && apt-get -y --no-install-recommends install \
    git \
    curl \
    libzip-dev\
    libonig-dev \
    libxml2-dev \
    libfreetype6-dev \
    libpng-dev \
    libjpeg62-turbo-dev \
    libzstd-dev \
    zip \
    unzip \
    dos2unix \
    supervisor \
    $PHPIZE_DEPS     

# compile native PHP packages

RUN docker-php-ext-install -j$(nproc) \
    opcache \
    intl \
    pdo \
    pdo_mysql \
    mbstring \
    exif \
    pcntl \
    bcmath \
    gd 

# configure packages

RUN  docker-php-ext-configure gd --with-freetype --with-jpeg 






