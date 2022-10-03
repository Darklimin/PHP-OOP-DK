<?php

declare(strict_types=1);

require_once './vendor/autoload.php';

use DariusKliminskas\Pretest\Framework\DIContainer;
use DariusKliminskas\Pretest\Framework\Router;

$container = new DIContainer();
$router = $container->get(Router::class);
$router->enterData();
