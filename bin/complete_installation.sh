#!/bin/bash

CURRENT_PWD=$(pwd)
cd /code
composer install
symfony console doctrine:migrations:migrate -n

cd "${CURRENT_PWD}"