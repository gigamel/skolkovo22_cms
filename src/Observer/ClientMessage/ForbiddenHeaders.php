<?php

declare(strict_types=1);

namespace App\Observer\ClientMessage;

use App\Event\BeforeRoutingEvent;
use Gigamel\Http\HttpException;
use Gigamel\Http\Protocol\ServerMessage\Code;

final class ForbiddenHeaders
{
    public function __invoke(BeforeRoutingEvent $event): bool
    {
        if ($event->getClientMessage()->hasHeader('Cross-Origin')) {
            throw new HttpException('Access Denied', Code::FORBIDDEN);
        }

        return false;
    }
}
