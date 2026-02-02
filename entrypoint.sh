#!/usr/bin/env sh
set -e

APP_DIR="/var/www/html"

cd "$APP_DIR"

if [ ! -f .env ] && [ -f .env.example ]; then
  cp .env.example .env
fi

if [ -f composer.json ] && [ ! -d vendor ]; then
  composer install --no-interaction --prefer-dist --optimize-autoloader
fi

if [ -f artisan ]; then
  php artisan storage:link >/dev/null 2>&1 || true
fi

chown -R www-data:www-data storage bootstrap/cache

exec "$@"
