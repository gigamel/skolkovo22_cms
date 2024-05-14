<?php

declare(strict_types=1);

use App\Admin\Controller\AuthorizationController;
use App\Admin\Controller\CategoriesController;
use App\Admin\Controller\DashboardController;
use App\Admin\Controller\EstatesController;
use App\Admin\Controller\PagesController;
use App\Admin\Controller\UsersController;
use App\Admin\Http\Router;
use App\Common\Browser\Url;
use App\Framework\Http\Protocol\ClientMessageInterface;

$router = new Router(
    [
        'id'   => '[1-9]+[0-9]*',
        'page' => '[1-9]+[0-9]*',
    ],
    Url::webRoot()
);

$router->route(
    'dashboard',
    '/',
    DashboardController::class,
    'dashboard',
    [ClientMessageInterface::METHOD_GET]
);

$router->route(
    'authorization.login',
    '/login/',
    AuthorizationController::class,
    'login',
    [ClientMessageInterface::METHOD_GET, ClientMessageInterface::METHOD_POST]
);

$router->route(
    'authorization.logout',
    '/logout/',
    AuthorizationController::class,
    'logout',
    [ClientMessageInterface::METHOD_GET, ClientMessageInterface::METHOD_POST]
);

$router->route(
    'settings',
    '/settings/',
    DashboardController::class,
    'settings',
    [ClientMessageInterface::METHOD_GET, ClientMessageInterface::METHOD_POST]
);

$router->route(
    'users',
    '/users/page/{page}',
    UsersController::class,
    'list',
    [ClientMessageInterface::METHOD_GET]
);

$router->route(
    'users.add',
    '/users/add/',
    UsersController::class,
    'show',
    [ClientMessageInterface::METHOD_GET, ClientMessageInterface::METHOD_POST]
);

$router->route(
    'users.edit',
    '/users/edit/{id}',
    UsersController::class,
    'show',
    [ClientMessageInterface::METHOD_GET, ClientMessageInterface::METHOD_POST]
);

$router->route(
    'users.delete',
    '/users/delete/{id}',
    UsersController::class,
    'delete',
    [ClientMessageInterface::METHOD_GET, ClientMessageInterface::METHOD_POST]
);

$router->route(
    'pages',
    '/pages/page/{page}',
    PagesController::class,
    'list',
    [ClientMessageInterface::METHOD_GET]
);

$router->route(
    'pages.add',
    '/pages/add/',
    PagesController::class,
    'add',
    [ClientMessageInterface::METHOD_GET, ClientMessageInterface::METHOD_POST]
);

$router->route(
    'pages.edit',
    '/pages/edit/{id}',
    PagesController::class,
    'show',
    [ClientMessageInterface::METHOD_GET, ClientMessageInterface::METHOD_POST]
);

$router->route(
    'pages.delete',
    '/pages/delete/{id}',
    PagesController::class,
    'delete',
    [ClientMessageInterface::METHOD_GET, ClientMessageInterface::METHOD_POST]
);

$router->route(
    'estates',
    '/estates/page/{page}',
    EstatesController::class,
    'list',
    [ClientMessageInterface::METHOD_GET]
);

$router->route(
    'estates.edit',
    '/estates/edit/{id}',
    EstatesController::class,
    'show',
    [ClientMessageInterface::METHOD_GET, ClientMessageInterface::METHOD_POST]
);

$router->route(
    'estates.add',
    '/estates/add/',
    EstatesController::class,
    'add',
    [ClientMessageInterface::METHOD_GET, ClientMessageInterface::METHOD_POST]
);

$router->route(
    'estates.delete',
    '/estates/delete/{id}',
    EstatesController::class,
    'delete',
    [ClientMessageInterface::METHOD_GET, ClientMessageInterface::METHOD_POST]
);

$router->route(
    'estates.categories',
    '/estates/categories/page/{page}',
    CategoriesController::class,
    'list',
    [ClientMessageInterface::METHOD_GET]
);

$router->route(
    'estates.category.add',
    '/estates/category/add/',
    CategoriesController::class,
    'add',
    [ClientMessageInterface::METHOD_GET, ClientMessageInterface::METHOD_POST]
);

$router->route(
    'estates.category.edit',
    '/estates/category/edit/{id}',
    CategoriesController::class,
    'show',
    [ClientMessageInterface::METHOD_GET, ClientMessageInterface::METHOD_POST]
);

$router->route(
    'estates.category.delete',
    '/estates/category/delete/{id}',
    CategoriesController::class,
    'delete',
    [ClientMessageInterface::METHOD_GET, ClientMessageInterface::METHOD_POST]
);

return $router;
