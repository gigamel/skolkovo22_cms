<?php

declare(strict_types=1);

namespace App\Framework\Http\Routing;

use App\Framework\Http\Protocol\ClientMessageInterface;

interface RouterInterface
{
    /**
     * @param string $name
     * @param array $vars
     *
     * @return string
     *
     * @throws RouteNotFoundException
     */
    public function getRouteUrl(string $name, array $vars = []): string;
    
    /**
     * @param string $name
     * @param string $rule
     * @param string $controller
     * @param string $action
     * @param string[] $methods
     *
     * @return void
     */
    public function route(
        string $name,
        string $rule,
        string $controller,
        string $action,
        array $methods = ClientMessageInterface::HTTP_METHODS
    ): void;
    
    /**
     * @param ClientMessageInterface $request
     *
     * @return RouteInterface
     *
     * @throws RouteNotFoundException
     */
    public function handle(ClientMessageInterface $request): RouteInterface;
}
