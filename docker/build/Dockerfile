FROM php:apache

RUN a2enmod rewrite
RUN apt-get update && docker-php-ext-install pdo_mysql
