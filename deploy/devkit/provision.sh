#!/bin/bash
CURRENT_PWD=$(pwd -L)
BASEDIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )"/../../ && pwd )"
PPENV='DEVKIT_ENV'
DEBUG='true'

source ${BASEDIR}/deploy/functions.sh

gen_app

echo '';
echo '[46;30m - Starting: MoneyFGE Provision   [49;39m';

cd ${BASEDIR}

composer_install;

pre_provision;

provision_clean;

cd ${CURRENT_PWD}

echo '[46;30m - Done: MoneyFGE Provision   [49;39m';
