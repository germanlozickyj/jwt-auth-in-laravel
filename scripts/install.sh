#!/bin/bash

docker run --rm -u "$(id -u):$(id -g)" -v $(pwd):/var/www/html -w /var/www/html composer:latest composer install --ignore-platform-reqs --no-scripts

cp .env.example .env
vendor/bin/sail down -v
vendor/bin/sail up -d
echo "Getting up mysql container..."
sleep 15
vendor/bin/sail artisan key:generate
vendor/bin/sail artisan migrate:fresh --seed
vendor/bin/sail php artisan jwt:generate-certs --force --algo=rsa --bits=4096 --sha=512 --passphrase=jwt-passhrase
vendor/bin/sail php ./vendor/bin/pest --parallel --colors
vendor/bin/sail php artisan ascii:logo