# Use official PHP Apache image
FROM php:8.2-apache

# Install system dependencies (added default-mysql-client)
RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    libicu-dev \
    curl \
    netcat-openbsd \
    && docker-php-ext-install pdo pdo_mysql zip opcache intl

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy application source (vendor is excluded via .dockerignore)
COPY . /var/www/html

# Expose default Apache port
EXPOSE 80
