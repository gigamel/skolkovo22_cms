<?php

declare(strict_types=1);

namespace App\Event;

use Gigamel\Http\Protocol\ClientMessageInterface;
use Gigamel\Http\Router\RoutesCollectionInterface;

final class RoutesCollectionEvent
{
    public function __construct(
        private readonly ClientMessageInterface $clientMessage,
        private RoutesCollectionInterface $routesCollection
    ) {
    }

    public function getRoutesCollection(): RoutesCollectionInterface
    {
        return $this->routesCollection;
    }

    public function getClientMessage(): ClientMessageInterface
    {
        return $this->clientMessage;
    }
}
