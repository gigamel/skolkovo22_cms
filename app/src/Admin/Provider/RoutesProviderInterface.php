<?php

declare(strict_types=1);

namespace App\Admin\Provider;


use Skolkovo22\Http\Routing\RouterInterface;

interface RoutesProviderInterface
{
    /**
     * @param RouterInterface $router
     *
     * @return void
     */
    public function setupRoutes(RouterInterface $router): void;
}
