FROM php:7.2

RUN apt-get update \
    && apt-get install unzip \
    && docker-php-ext-install pdo_mysql \
    && pecl install xdebug-2.8.1 \
    && docker-php-ext-enable xdebug

COPY --from=composer:1.10 /usr/bin/composer /usr/bin/composer
