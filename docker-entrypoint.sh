#!/bin/bash
set -e

echo "Running deployment scripts..."

# Ensure database directory and file exist with correct permissions
echo "Setting up SQLite database..."
mkdir -p /var/www/database
touch /var/www/database/database.sqlite
chown -R www-data:www-data /var/www/database
chmod 775 /var/www/database
chmod 664 /var/www/database/database.sqlite

# Set correct permissions for storage and cache
echo "Setting permissions..."
chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Install/update composer dependencies (production only)
echo "Installing composer dependencies..."
composer install --no-dev --optimize-autoloader --no-interaction

# Run database migrations
echo "Running database migrations..."
php artisan migrate --force

echo "Deployment complete!"

# Start PHP-FPM
exec php-fpm
