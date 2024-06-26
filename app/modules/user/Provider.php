<?php

declare(strict_types=1);

namespace modules\user;

use App\Admin\Provider\RoutesProviderInterface;
use App\Framework\Http\Protocol\ClientMessageInterface;
use modules\user\src\controller\AdminController;
use Skolkovo22\Http\Routing\RouterInterface;

class Provider implements RoutesProviderInterface
{
    /**
     * @inheritDoc
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
