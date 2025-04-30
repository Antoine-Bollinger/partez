#!/bin/sh

# Wait for MySQL to be available on port 3306
echo "⏳ Waiting for MySQL to be available at db:3306..."

while ! nc -z db 3306; do
  sleep 1
done

echo "✅ MySQL is up!"

# Ensure permissions and install dependencies
chown -R www-data:www-data /var/www/html/vendor

composer install

# Run migrations
php bricolo migrate

# Start Apache
exec apache2-foreground
