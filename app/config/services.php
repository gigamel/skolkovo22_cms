<?php

use App\Admin\Http\Router;
use App\Common\Storage\Connection;
use App\Framework\Dependency\ContainerInterface;
use App\Framework\Http\Routing\RouterInterface;
use App\Framework\Storage\ConnectionInterface;

/** @var ContainerInterface $container */

$container->set(RouterInterface::class, Router::class);
$container->set(ConnectionInterface::class, Connection::class);
