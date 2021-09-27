FROM php:7.4-fpm

ENV XDEBUG_MODE coverage

RUN pecl install -f xdebug \
    && docker-php-ext-enable xdebug

WORKDIR /app