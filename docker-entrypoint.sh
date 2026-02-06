#!/bin/bash
set -e

echo "Running deployment scripts..."

# Set correct permissions for storage, cache, and database
echo "Setting permissions..."
chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache /var/www/database
chmod -R 775 /var/www/storage /var/www/bootstrap/cache /var/www/database

# Install/update composer dependencies (production only)
echo "Installing composer dependencies..."
composer install --no-dev --optimize-autoloader --no-interaction

# Run database migrations
echo "Running database migrations..."
php artisan migrate --force

echo "Deployment complete!"

# Start PHP-FPM
exec php-fpm
