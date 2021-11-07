#!/usr/bin/env bash

set -ex


docker-compose build

# init laravel
docker-compose exec php74-httpd "touch /var/www/html/jobbook-laravel/storage/logs/laravel.log"
docker-compose exec php74-httpd "mkdir -p /var/www/html/jobbook-laravel/storage/logs/"
docker-compose exec php74-httpd "chmod 777 -R /var/www/html/jobbook-laravel/storage/logs/"
docker-compose exec php74-httpd "chmod 777 -R /var/www/html/jobbook-laravel/bootstrap/cache"
docker-compose exec php74-httpd "chmod 777 -R /var/www/html/jobbook-laravel/storage/framework/sessions"
docker-compose exec php74-httpd "chmod 777 -R /var/www/html/jobbook-laravel/storage/framework/views"

docker-compose up -d
docker-compose logs -f
