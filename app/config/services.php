<?php

use App\Admin\Http\Router;
use App\Common\Render\TemplateEngine;
use App\Common\Storage\Connection;
use App\Framework\Dependency\ContainerInterface;
use App\Framework\Http\Routing\RouterInterface;
use App\Framework\Render\TemplateEngineInterface;
use App\Framework\Storage\ConnectionInterface;
use App\Service\User\UserRepository;

/** @var ContainerInterface $container */

$container->set(RouterInterface::class, Router::class);
$container->set(ConnectionInterface::class, Connection::class);
$container->set(TemplateEngineInterface::class, TemplateEngine::class);
$container->set(UserRepository::class, UserRepository::class);
