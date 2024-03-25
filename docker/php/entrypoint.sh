#!/bin/sh
if [ ! -f "vendor/autoload.php" ]; then
  composer install
fi

if [ ! -f ".env" ]; then
   cp .env.example .env
fi

php artisan migrate
php artisan key:generate
php artisan cache:clear
php artisan config:clear
php artisan route:clear
echo 'done!!!!!!!!!'
exec docker-php-entrypoint "$@"