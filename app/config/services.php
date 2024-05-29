<?php

use App\Admin\Http\Router;
use App\Common\Render\TemplateEngine;
use App\Common\Storage\Connection;
use App\Framework\Dependency\ContainerInterface;
use App\Framework\EventsListener\EventsListener;
use App\Framework\EventsListener\EventsListenerInterface;
use App\Framework\Render\TemplateEngineInterface;
use App\Framework\Storage\ConnectionInterface;
use App\Service\User\UserRepository;
use Skolkovo22\Http\Routing\RouterInterface;

/** @var ContainerInterface $container */

$container->set(EventsListenerInterface::class, EventsListener::class);
$container->set(RouterInterface::class, Router::class);
$container->set(TemplateEngineInterface::class, TemplateEngine::class);
$container->set(ConnectionInterface::class, Connection::class);
$container->set(UserRepository::class, UserRepository::class);
