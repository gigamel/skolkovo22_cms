<?php

declare(strict_types=1);

namespace App\Event;

use Gigamel\Http\Protocol\ClientMessageInterface;
use Gigamel\Http\Protocol\ServerMessageInterface;

class BeforeRoutingEvent
{
    private ?ServerMessageInterface $serverMessage = null;

    public function __construct(
        private readonly ClientMessageInterface $clientMessage
    ) {
    }

    public function getClientMessage(): ClientMessageInterface
    {
        return $this->clientMessage;
    }

    public function setServerMessage(ServerMessageInterface $serverMessage): void
    {
        $this->serverMessage = $serverMessage;
    }

    public function getServerMessage(): ?ServerMessageInterface
    {
        return $this->serverMessage;
    }

    public function hasServerMessage(): bool
    {
        return null !== $this->getServerMessage();
    }
}
