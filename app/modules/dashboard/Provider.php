<?php

declare(strict_types=1);

namespace modules\dashboard;

use App\Framework\Http\Protocol\ClientMessageInterface;
use App\Framework\Http\Routing\RouterInterface;
use modules\dashboard\src\controller\AdminController;

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
            'dashboard',
            '/',
            AdminController::class,
            'dashboard',
            [ClientMessageInterface::METHOD_GET]
        );
        
        $router->route(
            'settings',
            '/settings/',
            AdminController::class,
            'settings',
            [ClientMessageInterface::METHOD_GET, ClientMessageInterface::METHOD_POST]
        );
    }
}
