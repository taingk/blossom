FROM php:apache

RUN a2enmod rewrite

RUN docker-php-ext-install pdo_mysql

RUN apt-get update -y && apt-get install -y libpng-dev libfreetype6-dev
 
RUN docker-php-ext-configure gd \
        --with-freetype-dir=/usr/include/freetype2 \
    && docker-php-ext-install gd