#!/bin/bash

source ~/.devkit/money.env
if [ ! ${NGINX_CONFIG_DIR} ] ; then
  NGINX_CONFIG_DIR=~/.devkit/config/nginx
fi

if [ ! -d ${NGINX_CONFIG_DIR} ] ; then
  mkdir -p ${NGINX_CONFIG_DIR}
fi

BASEDIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"
cp -r ${BASEDIR}/ppdk-nginx/* ${NGINX_CONFIG_DIR}

sed -i -e 's/<container_name>/ppdk-php7-'${COMPOSE_PROJECT_NAME}'/g' ${NGINX_CONFIG_DIR}/conf.d/api.money.loc.conf