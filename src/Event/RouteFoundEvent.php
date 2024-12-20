<?php

declare(strict_types=1);

namespace App\Event;

use Gigamel\Http\Protocol\ClientMessageInterface;
use Gigamel\Http\Router\RouteShardInterface;

final class RouteFoundEvent
{
    public function __construct(
        private readonly ClientMessageInterface $message,
        private RouteShardInterface $routeShard
    ) {
    }

    public function getClientMessage(): ClientMessageInterface
    {
        return $this->message;
    }

    public function getRouteShard(): RouteShardInterface
    {
        return $this->routeShard;
    }

    public function setRouteShard(RouteShardInterface $routeShard): void
    {
        $this->routeShard = $routeShard;
    }
}
