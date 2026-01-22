FROM php:7.4-apache

# Устанавливаем системные зависимости
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-configure gd --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
    pdo \
    pdo_mysql \      
    mysqli \         
    gd \
    zip

# Включаем mod_rewrite для Apache
RUN a2enmod rewrite

# Настраиваем Apache для Yii
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Устанавливаем Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Создаем папку для приложения
WORKDIR /var/www/html

# Настраиваем права
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Создаем папки для Yii
RUN mkdir -p /var/www/html/protected/runtime \
    && mkdir -p /var/www/html/protected/data \
    && mkdir -p /var/www/html/assets \
    && chmod -R 777 /var/www/html/protected/runtime \
    /var/www/html/protected/data \
    /var/www/html/assets

EXPOSE 80