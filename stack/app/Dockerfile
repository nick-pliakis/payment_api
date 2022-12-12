FROM php:8.1.5-fpm

RUN apt update && apt install -y libpq-dev zlib1g-dev libzip-dev unzip && docker-php-ext-install mysqli pdo pdo_mysql pdo_pgsql zip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
