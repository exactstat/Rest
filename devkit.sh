#!/bin/bash

source ~/.devkit/money.env

time docker exec -it --user operations ppdk-php7-"$COMPOSE_PROJECT_NAME" bash -c "/devkit/srv/Rest/deploy/devkit/provision.sh"
