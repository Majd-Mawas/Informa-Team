#!/usr/bin/env bash

# Update Composer to version 2 if not already installed
echo "Updating Composer..."
composer self-update --2

# Ensure Composer dependencies are installed
echo "Running composer"
composer global require hirak/prestissimo
composer install --no-dev --working-dir=/var/www/html

# Set appropriate permissions
chown -R www-data:www-data /var/www/html
chmod -R 755 /var/www/html/storage
chmod -R 755 /var/www/html/bootstrap/cache

# Laravel setup
echo "Generating application key..."
php /var/www/html/artisan key:generate --show

echo "Caching config..."
php /var/www/html/artisan config:cache

echo "Caching routes..."
php /var/www/html/artisan route:cache

echo "Running migrations..."
php /var/www/html/artisan migrate --force

echo "Deployment script completed."
