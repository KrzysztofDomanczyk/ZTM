FROM php:8.3-fpm

WORKDIR /var/www/html

RUN apt-get update && apt-get install -y \
    zip unzip git curl libpq-dev libpng-dev libjpeg-dev libfreetype6-dev \
    && docker-php-ext-install pdo pdo_pgsql gd

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

CMD ["php-fpm"]