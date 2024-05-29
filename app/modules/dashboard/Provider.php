<?php

declare(strict_types=1);

namespace modules\dashboard;

use App\Admin\Provider\RoutesProviderInterface;
use App\Framework\Http\Protocol\ClientMessageInterface;
use modules\dashboard\src\controller\AdminController;
use Skolkovo22\Http\Routing\RouterInterface;

class Provider implements RoutesProviderInterface
{
    /**
     * @inheritDoc
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
