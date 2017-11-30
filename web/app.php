<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Debug\Debug;

/** @var \Composer\Autoload\ClassLoader $loader */
$loader = require __DIR__.'/../app/autoload.php';
Debug::enable(E_RECOVERABLE_ERROR & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED, false);
$kernel = new AppKernel(AppKernel::DEVKIT_ENV, true);
$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);
