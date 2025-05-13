#!/bin/sh

# Wait for MySQL to be available on port 3306
echo "⏳ Waiting for MySQL to be available at db:3306..."
while ! nc -z db 3306; do
  sleep 1
done
echo "✅ MySQL is up!"

# Set server qualified name
echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Install php dependencies
composer install

# Ensure permissions
chown -R www-data:www-data /var/www/html/vendor

# Run migrations
php bricolo migrate

# Start Apache
exec apache2-foreground
