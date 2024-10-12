<?php declare(strict_types=1);

namespace App\Common\Http\Routing;

use App\Common\Http\Protocol\ClientMessageInterface;
use App\Common\Http\HttpException;

interface RouterInterface
{
    /**
     * @throws HttpException
     */
    public function handleClientMessage(ClientMessageInterface $clientMessage): string;
    
    public function setSegment(string $segment, string $regEx): void;
}
