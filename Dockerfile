FROM php:8.4-cli

RUN apt-get update && apt-get install -y \
    git unzip zip curl \
    libicu-dev \
    && docker-php-ext-install bcmath intl \
    && pecl install pcov \
    && docker-php-ext-enable pcov \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/core

RUN git config --global --add safe.directory /var/www/core