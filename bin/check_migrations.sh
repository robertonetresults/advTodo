#!/bin/bash

CURRENT_PWD=$(pwd)
cd /code
symfony console doctrine:migrations:migrate -n

cd "${CURRENT_PWD}"