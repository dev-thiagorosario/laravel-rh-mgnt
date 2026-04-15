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
  if ! grep -q '^APP_KEY=base64:' .env 2>/dev/null; then
    php artisan key:generate --force --no-interaction
  fi
  php artisan storage:link >/dev/null 2>&1 || true
fi

chown -R www-data:www-data storage bootstrap/cache

exec "$@"
