#!/bin/bash

# Render-specific entrypoint script
set -e

echo "Starting Render deployment..."

# Wait for database to be ready (PostgreSQL)
echo "Waiting for database connection..."
for i in {1..30}; do
    if php artisan db:monitor > /dev/null 2>&1; then
        echo "Database is ready!"
        break
    fi
    echo "Attempt $i: Database not ready, waiting..."
    sleep 2
done

# Run migrations
echo "Running database migrations..."
php artisan migrate --force

# Clear and optimize
echo "Optimizing application..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Create storage link
if [ ! -L /var/www/html/public/storage ]; then
    echo "Creating storage symlink..."
    php artisan storage:link
fi

# Set proper permissions
echo "Setting permissions..."
chown -R www-data:www-data /var/www/html/storage
chown -R www-data:www-data /var/www/html/bootstrap/cache
chmod -R 755 /var/www/html/storage
chmod -R 755 /var/www/html/bootstrap/cache

# Update Render-specific nginx config for dynamic PORT
if [ -n "$PORT" ]; then
    echo "Configuring nginx for PORT=$PORT"
    sed -i "s/listen 80;/listen $PORT;/g" /etc/nginx/http.d/default.conf
    sed -i "s/listen 8080;/listen $PORT;/g" /etc/nginx/http.d/default.conf
fi

echo "Starting services..."
exec "$@"
