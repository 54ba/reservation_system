FROM php:8.1-fpm


USER root

#RUN rm /usr/local/bin/docker-php-entrypoint 
#COPY ./docker-php-entrypoint   /usr/local/bin/
#COPY ./docker-php-entrypoint-dev   /usr/local/bin/

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
    $PHPIZE_DEPS \
    libpcre3-dev \
    libbz2-dev



RUN apt-get update && apt-get install -y \
    && docker-php-ext-configure gd --with-freetype --with-jpeg 

RUN docker-php-ext-install -j$(nproc) \
    opcache \
    intl \
    mysqli \
    pdo \
    pdo_mysql \
    mbstring \
    exif \
    pcntl \
    bcmath \
    gd \
    bz2



# install additional packages from PECL

RUN echo 'apc.enable_cli = 1' >> /usr/local/etc/php/conf.d/docker-php-ext-apcu.ini \
    && pecl install apcu-5.1.21 \
    && docker-php-ext-enable apcu





# Create a new user
#RUN adduser --disabled-password --gecos '' developer
#RUN useradd --disabled-password --gecos '' developer || echo "User already exists."

# Add user to the group
#RUN chown -R developer:www-data /var/www

RUN chmod 755 /var/www
RUN chmod -R ugo+rw /var/www/html/storage
# Switch to this user
#USER developer


#add custom php-fpm pool settings, these get written at entrypoint startup

ENV FPM_PM_MAX_CHILDREN=20 \
    FPM_PM_START_SERVERS=2 \
    FPM_PM_MIN_SPARE_SERVERS=1 \
    FPM_PM_MAX_SPARE_SERVERS=3

#set application environment variables

ENV APP_NAME="TicketPoss" \
    APP_ENV=development \
    APP_DEBUG=true

