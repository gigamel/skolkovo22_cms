<?php

declare(strict_types=1);

namespace App\Service\Auth\Observer;

use App\Event\RoutesCollectionEvent;
use App\Event\RouteFoundEvent;
use App\Service\Auth\Controller\LogoutController;
use Gigamel\Http\Protocol\ClientMessageInterface;
use Gigamel\Http\Route;
use Gigamel\Http\ServerMessage;
use Gigamel\Http\Server\SessionInterface;

final class LogoutPage
{
    public function __construct(
        private SessionInterface $session
    ) {
    }

    public function __invoke(RoutesCollectionEvent $event): bool
    {
        $isAuthorized = $this->session->exists('is_auth');

        if ($isAuthorized) {
            $event->getRoutesCollection()->add(new Route('logout', '/admin/logout/', LogoutController::class));
        }

        return $isAuthorized;
    }
}
