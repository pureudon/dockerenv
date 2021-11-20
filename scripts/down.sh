#!/usr/bin/env bash

set -ex

docker-compose kill || true
docker-compose down || true

sudo git checkout mysql/db_data/var/lib/mysql/ib_logfile0
sudo git checkout mysql/db_data/var/lib/mysql/ibdata1
