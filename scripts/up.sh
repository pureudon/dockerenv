#!/usr/bin/env bash

set -ex

docker-compose kill || true
docker-compose down || true


docker-compose build
docker-compose up --no-start

docker-compose up -d

sleep 1

# # init laravel
docker-compose exec -T php74-httpd mkdir -p /var/www/html/jobbook-laravel/storage/logs
docker-compose exec -T php74-httpd touch /var/www/html/jobbook-laravel/storage/logs/laravel.log
docker-compose exec -T php74-httpd chmod 777 -R /var/www/html/jobbook-laravel/storage/logs/laravel.log

docker-compose exec -T php74-httpd chmod 777 -R /var/www/html/jobbook-laravel/storage/logs/
docker-compose exec -T php74-httpd chmod 777 -R /var/www/html/jobbook-laravel/bootstrap/cache
docker-compose exec -T php74-httpd chmod 777 -R /var/www/html/jobbook-laravel/storage/framework/sessions
docker-compose exec -T php74-httpd chmod 777 -R /var/www/html/jobbook-laravel/storage/framework/views


# docker-compose logs -f
