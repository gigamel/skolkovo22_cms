<?php

declare(strict_types=1);

namespace modules\auth;

use App\Admin\Provider\EventsProviderInterface;
use App\Admin\Provider\RoutesProviderInterface;
use App\Framework\EventsListener\EventsListenerInterface;
use App\Framework\Http\Protocol\ClientMessageInterface;
use App\Framework\Http\Routing\RouterInterface;
use modules\auth\src\controller\AdminController;
use modules\auth\src\event\CheckAuthEvent;

class Provider implements RoutesProviderInterface, EventsProviderInterface
{
    /**
    * @inheritDoc
    */
    public function setupRoutes(RouterInterface $router): void
    {
        $router->route(
            'authorization.login',
            '/login/',
            AdminController::class,
            'login',
            [ClientMessageInterface::METHOD_GET, ClientMessageInterface::METHOD_POST]
        );
        
        $router->route(
            'authorization.logout',
            '/logout/',
            AdminController::class,
            'logout',
            [ClientMessageInterface::METHOD_GET, ClientMessageInterface::METHOD_POST]
        );
    }

    /**
     * @inheritDoc
     */
    public function registerEvents(EventsListenerInterface $eventsListener): void
    {
        $eventsListener->on('route.found', CheckAuthEvent::class);
    }
}
