FROM composer:2 as build-project-vendor

WORKDIR /app

COPY composer.json composer.json
COPY composer.lock composer.lock

RUN composer install --ignore-platform-reqs --no-scripts

COPY . .

FROM php:8.3-apache

USER root

WORKDIR /var/www/html

RUN apt-get update && apt-get install -y \
        libpq-dev \
        libpng-dev \
        libzip-dev \
        curl \
        unzip \
    && docker-php-ext-install -j$(nproc) pdo pdo_pgsql gd zip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*


COPY .docker/vhost.conf /etc/apache2/sites-available/000-default.conf
COPY .docker/php-config.ini $PHP_INI_DIR/conf.d/php-overrides.ini
COPY . /var/www/html

COPY --from=build-project-vendor /app/vendor ./vendor
COPY --from=build-project-vendor /usr/bin/composer /usr/bin/composer

RUN composer dump-autoload

RUN chown -R www-data:www-data /var/www/html \
    && a2enmod rewrite

RUN useradd -ms /bin/bash ztm

EXPOSE 80
