FROM php:7.4-apache
RUN a2enmod rewrite

RUN docker-php-ext-install pdo_mysql
RUN apt-get update && \
    apt-get install -y zlib1g-dev libicu-dev g++ && \
    docker-php-ext-configure intl && \
    docker-php-ext-install intl && \
    docker-php-ext-install opcache

RUN pecl install xdebug && docker-php-ext-enable xdebug

# Lib de Zip do PHP
RUN apt-get install -y libzip-dev zip && \
    docker-php-ext-install zip

# Editor de textos
RUN apt-get install -y vim