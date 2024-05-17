<?php

declare(strict_types=1);

namespace App\Admin\Http\Pipeline;

use App\Framework\Http\Pipeline\MiddlewareInterface;
use App\Framework\Http\Protocol\ClientMessageInterface;
use App\Framework\Http\Protocol\ServerMessageInterface;
use App\Framework\Http\Response;

class AuthMiddleware implements MiddlewareInterface
{
    /**
     * @param ClientMessageInterface $request
     * @param callable $middleware
     *
     * @return ServerMessageInterface
     */
    public function handle(ClientMessageInterface $request, callable $middleware): ServerMessageInterface
    {
        if ($request->hasAttribute('authorized')) {
            return $middleware($request);
        }
        
        return new Response('UNATHORIZED');
    }
}
