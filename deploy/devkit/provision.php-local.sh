#!/bin/bash
CURRENT_PWD=$(pwd -L)
BASEDIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )"/../../ && pwd )"
PPENV='DEVKIT_ENV'
DEBUG='true'

source ${BASEDIR}/deploy/functions.sh

cd ${BASEDIR}

cp app/config/parameters.devkit.yml app/config/parameters.yml
pre_provision;

provision_clean;

cd ${CURRENT_PWD}

echo '[46;30m - Done: MoneyFGE Provision   [49;39m';
