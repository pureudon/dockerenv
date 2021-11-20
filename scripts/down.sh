#!/usr/bin/env bash

set -ex

docker-compose kill || true
docker-compose down || true

sudo git checkout mysql/db_data/var/lib/mysql/ib_logfile0
sudo git checkout mysql/db_data/var/lib/mysql/ibdata1
sudo git checkout mysql/db_data/var/lib/mysql/ibtmp1
sudo git checkout mysql/db_data/var/lib/mysql/jobbook/datatypes.ibd

# sudo chmod 777 mysql/db_data/var/lib/mysql/ib_logfile0 &
# sudo chmod 777 mysql/db_data/var/lib/mysql/ibdata1 &
# sudo chmod 777 mysql/db_data/var/lib/mysql/ibtmp1 &
# sudo chmod 777 mysql/db_data/var/lib/mysql/jobbook/datatypes.ibd &

wait
