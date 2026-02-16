#!/bin/sh
set -e

cd /var/www/html

# Create .env from environment variables if it doesn't exist
if [ ! -f .env ]; then
    touch .env
fi

# Generate app key if not set
if [ -z "$APP_KEY" ]; then
    php artisan key:generate --force
fi

# Cache configuration for production
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Create storage link
php artisan storage:link --force 2>/dev/null || true

# Run migrations
php artisan migrate --force

# Seed only if tables are empty
php artisan db:seed --force 2>/dev/null || true

echo "Application ready!"

# Start supervisor (nginx + php-fpm)
exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf
