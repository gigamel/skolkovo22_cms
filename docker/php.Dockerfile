FROM php:8.3-fpm-alpine

WORKDIR /var/www/skolkovo22_cms

RUN docker-php-ext-install pdo pdo_mysql
