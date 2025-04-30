# Use official PHP Apache image
FROM php:8.2-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    libicu-dev \
    curl \
    && docker-php-ext-install pdo pdo_mysql zip opcache intl

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy composer files and install dependencies
COPY ./composer.json ./composer.lock ./
RUN composer install

# Copy the rest of the application source code (excluding vendor via .dockerignore)
COPY . /var/www/html

# Run migrations or other setup tasks
RUN php bricolo migrate

# Ensure appropriate permissions
RUN chown -R www-data:www-data /var/www/html/vendor

# Expose the port
EXPOSE 80
