<?php

declare(strict_types=1);

namespace App\Service\Auth\Observer;

use App\Event\RouteFoundEvent;
use App\Service\Auth\Controller\LoginController;
use Gigamel\Http\Protocol\ClientMessageInterface;
use Gigamel\Http\RouteShard;
use Gigamel\Http\ServerMessage;
use Gigamel\Http\Server\SessionInterface;

final class IsAuthPath
{
    public function __construct(
        private SessionInterface $session
    ) {
    }

    public function __invoke(RouteFoundEvent $event): bool
    {
        $needAuth = $this->isAuthPath($event->getClientMessage()) && !$this->session->exists('is_auth');

        if ($needAuth) {
            $event->setRouteShard(new RouteShard(LoginController::class));
        }

        return $needAuth;
    }

    private function isAuthPath(ClientMessageInterface $message): bool
    {
        return (bool) preg_match('~^/admin/~', $message->getPath());
    }
}
