<?php

declare(strict_types=1);

namespace App\Service\Auth\Observer;

use App\Event\BeforeRoutingEvent;
use Gigamel\Http\Server\SessionInterface;

final class StartSession
{
    public function __construct(
        private SessionInterface $session
    ) {
    }

    public function __invoke(BeforeRoutingEvent $event): bool
    {
        $this->session->start();
        return false;
    }
}
