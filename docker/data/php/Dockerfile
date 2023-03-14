FROM php:8.2.3-fpm

RUN curl -1sLf 'https://dl.cloudsmith.io/public/symfony/stable/setup.deb.sh' | bash \
    && apt-get update\
    && apt-get install -y \
        libpq-dev \
        libzip-dev \
        zlib1g-dev \
        unzip \
        git \
        symfony-cli \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && docker-php-ext-install -j$(nproc) zip \
    && docker-php-ext-install -j$(nproc) pgsql \
    && docker-php-ext-install -j$(nproc) pdo_pgsql
