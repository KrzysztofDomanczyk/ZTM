<?php
require __DIR__.'/../vendor/autoload.php';

use Infrastructure\Router;

$router = new Router();
$router->handle();