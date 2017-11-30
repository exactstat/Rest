#!/bin/bash

echo '';
echo '[46;30m - Starting: MoneyFGE Provision   [49;39m';

source ~/.devkit/money.env

CURRENT_PWD=$(pwd -L)
BASEDIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )"/ && pwd )"
PPENV='DEVKIT_ENV'
DEBUG='true'

source ${BASEDIR}/deploy/functions.sh

gen_app

cd ${BASEDIR}

composer_install;

syncd start
syncd run

time docker exec -it --user operations ppdk-php7-"$COMPOSE_PROJECT_NAME" bash -c "/devkit/srv/Rest/deploy/devkit/provision.php-local.sh "
