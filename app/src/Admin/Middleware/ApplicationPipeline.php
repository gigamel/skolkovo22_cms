<?php

declare(strict_types=1);

namespace App\Admin\Middleware;

use App\Framework\Http\Pipeline\MiddlewareInterface;
use App\Framework\Http\Protocol\ClientMessageInterface;
use App\Framework\Http\Protocol\ServerMessageInterface;
use App\Framework\Http\Routing\RouteInterface;

final class ApplicationPipeline
{
    /**
     * @param RouteInterface $route
     * @param MiddlewareInterface[] $middlewares
     */
    public function __construct(private RouteInterface $route, private array $middlewares = [])
    {
    }
    
    /**
     * @param ClientMessageInterface $request
     *
     * @return ServerMessageInterface
     */
    public function handle(ClientMessageInterface $request): ServerMessageInterface
    {
        $middleware = array_shift($this->middlewares);
        if (is_null($middleware)) {
            $controllerName = $this->route->getController();
            return (new $controllerName())->{$this->route->getAction()}($request);
        }
        
        return $middleware->handle($request, [$this, 'handle']);
    }
}
