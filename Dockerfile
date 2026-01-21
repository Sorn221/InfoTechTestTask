FROM php:7.4-apache

# Устанавливаем расширения PHP
RUN docker-php-ext-install pdo pdo_mysql mysqli
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    && docker-php-ext-configure gd --with-jpeg \
    && docker-php-ext-install gd

# Включаем mod_rewrite для Apache
RUN a2enmod rewrite

# Настраиваем Apache
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf