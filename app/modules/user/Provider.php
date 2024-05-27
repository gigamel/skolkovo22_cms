<?php

declare(strict_types=1);

namespace modules\user;

use App\Framework\Http\Protocol\ClientMessageInterface;
use App\Framework\Http\Routing\RouterInterface;
use modules\user\src\controller\AdminController;

class Provider
{
    /**
    * @param RouterInterface $router
    *
    * @return void
    */
    public function setupRoutes(RouterInterface $router): void
    {
        $router->route(
            'users',
            '/users/page/{page}',
            AdminController::class,
            'list',
            [ClientMessageInterface::METHOD_GET]
        );
        
        $router->route(
            'users.add',
            '/users/add/',
            AdminController::class,
            'add',
            [ClientMessageInterface::METHOD_GET, ClientMessageInterface::METHOD_POST]
        );
        
        $router->route(
            'users.edit',
            '/users/edit/{id}',
            AdminController::class,
            'show',
            [ClientMessageInterface::METHOD_GET, ClientMessageInterface::METHOD_POST]
        );
        
        $router->route(
            'users.delete',
            '/users/delete/{id}',
            AdminController::class,
            'delete',
            [ClientMessageInterface::METHOD_GET, ClientMessageInterface::METHOD_POST]
        );
    }
}
