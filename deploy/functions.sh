#!/bin/bash

CURRENT_PWD=$(pwd -L)
BASEDIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )"/../ && pwd )"

gen_app () {
    echo "<?php

use Symfony\Component\HttpFoundation\Request;" > ${BASEDIR}/web/app.php
[ "$DEBUG" == "true" ] && echo "use Symfony\Component\Debug\Debug;" >> ${BASEDIR}/web/app.php

echo "
/** @var \Composer\Autoload\ClassLoader \$loader */
\$loader = require __DIR__.'/../app/autoload.php';" >> ${BASEDIR}/web/app.php

[ "$DEBUG" == "true" ] && echo "Debug::enable(E_RECOVERABLE_ERROR & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED, false);" >> ${BASEDIR}/web/app.php

echo "\$kernel = new AppKernel(AppKernel::$PPENV, $DEBUG);" >> ${BASEDIR}/web/app.php

[ "$DEBUG" == "false" ] && echo "\$kernel = new AppCache(\$kernel);" >> ${BASEDIR}/web/app.php

echo "\$request = Request::createFromGlobals();
\$response = \$kernel->handle(\$request);
\$response->send();
\$kernel->terminate(\$request, \$response);" >> ${BASEDIR}/web/app.php
}

pre_provision () {
    php bin/console doctrine:cache:clear-result --env=devkit
    php bin/console doctrine:cache:clear-query --env=devkit
    php bin/console doctrine:cache:clear-metadata --env=devkit
    php bin/console doctrine:database:drop --if-exists --force --env=devkit
    php bin/console doctrine:database:create --env=devkit
}

provision_clean () {
#    php bin/console pp:resque-redis:clear
#    php bin/console doctrine:database:import deploy/db/data.sql --env=devkit
#    php bin/console doctrine:migrations:migrate --no-interaction --env=devkit
    php bin/console doctrine:schema:create --env=devkit
    php bin/console doctrine:schema:validate --env=devkit
    php bin/console oauth-client:create api.money.loc --grant password
    php bin/console user:create --username user1 --email user1@mail.ua --password user1passwd
    php bin/console user:create --username user2 --email user2@mail.ua --password user2passwd
    php bin/console user:create --username user3 --email user3@mail.ua --password user3passwd
}

composer_install () {
    cp app/config/parameters.devkit.yml app/config/parameters.yml
    env SYMFONY_ENV=devkit composer install
}