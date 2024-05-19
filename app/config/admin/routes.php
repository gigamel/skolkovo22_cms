<?php

declare(strict_types=1);

use App\Admin\Controller;
use App\Framework\Dependency\ContainerInterface;
use App\Framework\Http\Protocol\ClientMessageInterface;
use App\Framework\Http\Routing\RouterInterface;

/** @var ContainerInterface $container */

$container->get(RouterInterface::class)->route(
    'dashboard',
    '/',
    Controller\DashboardController::class,
    'dashboard',
    [ClientMessageInterface::METHOD_GET]
);

$container->get(RouterInterface::class)->route(
    'authorization.login',
    '/login/',
    Controller\AuthorizationController::class,
    'login',
    [ClientMessageInterface::METHOD_GET, ClientMessageInterface::METHOD_POST]
);

$container->get(RouterInterface::class)->route(
    'authorization.logout',
    '/logout/',
    Controller\AuthorizationController::class,
    'logout',
    [ClientMessageInterface::METHOD_GET, ClientMessageInterface::METHOD_POST]
);

$container->get(RouterInterface::class)->route(
    'settings',
    '/settings/',
    Controller\DashboardController::class,
    'settings',
    [ClientMessageInterface::METHOD_GET, ClientMessageInterface::METHOD_POST]
);

$container->get(RouterInterface::class)->route(
    'users',
    '/users/page/{page}',
    Controller\UsersController::class,
    'list',
    [ClientMessageInterface::METHOD_GET]
);

$container->get(RouterInterface::class)->route(
    'users.add',
    '/users/add/',
    Controller\UsersController::class,
    'show',
    [ClientMessageInterface::METHOD_GET, ClientMessageInterface::METHOD_POST]
);

$container->get(RouterInterface::class)->route(
    'users.edit',
    '/users/edit/{id}',
    Controller\UsersController::class,
    'show',
    [ClientMessageInterface::METHOD_GET, ClientMessageInterface::METHOD_POST]
);

$container->get(RouterInterface::class)->route(
    'users.delete',
    '/users/delete/{id}',
    Controller\UsersController::class,
    'delete',
    [ClientMessageInterface::METHOD_GET, ClientMessageInterface::METHOD_POST]
);

$container->get(RouterInterface::class)->route(
    'pages',
    '/pages/page/{page}',
    Controller\PagesController::class,
    'list',
    [ClientMessageInterface::METHOD_GET]
);

$container->get(RouterInterface::class)->route(
    'pages.add',
    '/pages/add/',
    Controller\PagesController::class,
    'add',
    [ClientMessageInterface::METHOD_GET, ClientMessageInterface::METHOD_POST]
);

$container->get(RouterInterface::class)->route(
    'pages.edit',
    '/pages/edit/{id}',
    Controller\PagesController::class,
    'show',
    [ClientMessageInterface::METHOD_GET, ClientMessageInterface::METHOD_POST]
);

$container->get(RouterInterface::class)->route(
    'pages.delete',
    '/pages/delete/{id}',
    Controller\PagesController::class,
    'delete',
    [ClientMessageInterface::METHOD_GET, ClientMessageInterface::METHOD_POST]
);

$container->get(RouterInterface::class)->route(
    'estates',
    '/estates/page/{page}',
    Controller\EstatesController::class,
    'list',
    [ClientMessageInterface::METHOD_GET]
);

$container->get(RouterInterface::class)->route(
    'estates.edit',
    '/estates/edit/{id}',
    Controller\EstatesController::class,
    'show',
    [ClientMessageInterface::METHOD_GET, ClientMessageInterface::METHOD_POST]
);

$container->get(RouterInterface::class)->route(
    'estates.add',
    '/estates/add/',
    Controller\EstatesController::class,
    'add',
    [ClientMessageInterface::METHOD_GET, ClientMessageInterface::METHOD_POST]
);

$container->get(RouterInterface::class)->route(
    'estates.delete',
    '/estates/delete/{id}',
    Controller\EstatesController::class,
    'delete',
    [ClientMessageInterface::METHOD_GET, ClientMessageInterface::METHOD_POST]
);

$container->get(RouterInterface::class)->route(
    'estates.categories',
    '/estates/categories/page/{page}',
    Controller\CategoriesController::class,
    'list',
    [ClientMessageInterface::METHOD_GET]
);

$container->get(RouterInterface::class)->route(
    'estates.category.add',
    '/estates/category/add/',
    Controller\CategoriesController::class,
    'add',
    [ClientMessageInterface::METHOD_GET, ClientMessageInterface::METHOD_POST]
);

$container->get(RouterInterface::class)->route(
    'estates.category.edit',
    '/estates/category/edit/{id}',
    Controller\CategoriesController::class,
    'show',
    [ClientMessageInterface::METHOD_GET, ClientMessageInterface::METHOD_POST]
);

$container->get(RouterInterface::class)->route(
    'estates.category.delete',
    '/estates/category/delete/{id}',
    Controller\CategoriesController::class,
    'delete',
    [ClientMessageInterface::METHOD_GET, ClientMessageInterface::METHOD_POST]
);
