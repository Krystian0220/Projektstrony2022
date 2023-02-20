FROM php:8.1-fpm

RUN apt-get update  \
    && apt-get install -y  libpq-dev libpng-dev libzip-dev zip  \
    && docker-php-ext-install zip pdo_mysql sysvsem gd bcmath \
    && apt-get clean \
    && curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer

WORKDIR /var/www/krystian