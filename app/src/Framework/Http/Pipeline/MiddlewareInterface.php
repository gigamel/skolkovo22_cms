<?php

declare(strict_types=1);

namespace App\Framework\Http\Pipeline;

use App\Framework\Http\Protocol\ClientMessageInterface;
use App\Framework\Http\Protocol\ServerMessageInterface;

interface MiddlewareInterface
{
    /**
     * @param ClientMessageInterface $request
     * @param callable $middleware
     *
     * @return ServerMessageInterface
     */
    public function handle(ClientMessageInterface $request, callable $middleware): ServerMessageInterface;
}
