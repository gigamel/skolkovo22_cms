<?php

declare(strict_types=1);

namespace modules\page;

use App\Admin\Provider\RoutesProviderInterface;
use modules\page\src\controller\AdminController;
use Skolkovo22\Http\Protocol\ClientMessageInterface;
use Skolkovo22\Http\Routing\RouterInterface;

class Provider implements RoutesProviderInterface
{
    /**
     * @inheritDoc
     */
    public function setupRoutes(RouterInterface $router): void
    {
        $router->route(
            'pages',
            '/pages/page/{page}',
            AdminController::class,
            'list',
            [ClientMessageInterface::METHOD_GET]
        );
        
        $router->route(
            'pages.add',
            '/pages/add/',
            AdminController::class,
            'add',
            [ClientMessageInterface::METHOD_GET, ClientMessageInterface::METHOD_POST]
        );
        
        $router->route(
            'pages.edit',
            '/pages/edit/{id}',
            AdminController::class,
            'show',
            [ClientMessageInterface::METHOD_GET, ClientMessageInterface::METHOD_POST]
        );
        
        $router->route(
            'pages.delete',
            '/pages/delete/{id}',
            AdminController::class,
            'delete',
            [ClientMessageInterface::METHOD_GET, ClientMessageInterface::METHOD_POST]
        );
    }
}
