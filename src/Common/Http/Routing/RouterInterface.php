<?php declare(strict_types=1);

namespace App\Common\Http\Routing;

use Sklkv22\Http\Protocol\ClientMessageInterface;

interface RouterInterface
{
    public function handleClientMessage(ClientMessageInterface $clientMessage): ActionInterface;
}
