<?php

declare(strict_types=1);

use App\Event\BeforeRoutingEvent;

return [
    BeforeRoutingEvent::class => [
        App\Observer\ClientMessage\ForbiddenHeaders::class,
    ],
];
