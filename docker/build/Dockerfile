FROM php:apache

RUN a2enmod rewrite
RUN apt-get update -y && apt-get install -y libpng-dev
RUN docker-php-ext-install pdo_mysql  
RUN docker-php-ext-install gd