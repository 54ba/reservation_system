ARG PHP_VERSION="8.1"

FROM php:${PHP_VERSION}-fpm-alpine

RUN mkdir -p "/etc/supervisor/logs"

# copy entrypoint files
COPY laravel-worker.conf  /etc/supervisor/laravel-worker.conf

