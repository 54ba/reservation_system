ARG PHP_VERSION="8.1"

FROM php:${PHP_VERSION}-fpm

WORKDIR /var/www/html

#add custom php-fpm pool settings, these get written at entrypoint startup

ENV FPM_PM_MAX_CHILDREN=20 \
    FPM_PM_START_SERVERS=2 \
    FPM_PM_MIN_SPARE_SERVERS=1 \
    FPM_PM_MAX_SPARE_SERVERS=3
    
#set application environment variables

ENV APP_NAME="TicketPoss" \
    APP_ENV=development \
    APP_DEBUG=true

