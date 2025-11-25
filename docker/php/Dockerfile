FROM php:8.2-fpm

# Установка зависимостей
RUN apt-get update && apt-get install -y \
    libpq-dev \
    zip unzip curl git \
    unzip \
    && docker-php-ext-install pdo pdo_pgsql \
    && pecl install redis \
    && docker-php-ext-enable redis

# Установка Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# Установка Node.js
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - && \
    apt-get install -y nodejs

# Настройка загрузки файлов
RUN echo "upload_max_filesize=20M" > /usr/local/etc/php/conf.d/uploads.ini && \
    echo "post_max_size=25M" >> /usr/local/etc/php/conf.d/uploads.ini





























