<?php

declare(strict_types=1);

namespace App\Admin\Http;

use App\Common\Browser\Url;
use Skolkovo22\Http\Protocol\ClientMessageInterface;
use Skolkovo22\Http\Router as Skolkovo22Router;

final class Router extends Skolkovo22Router
{
    /**
     * @inheritDoc
     */
    public function route(
        string $name,
        string $rule,
        string $controller,
        string $action,
        array $methods = ClientMessageInterface::HTTP_METHODS
    ): void {
        parent::route(
            $name,
            rtrim(Url::webRoot(), '/') . '/' . ltrim($rule, '/'),
            $controller,
            $action,
            $methods
        );
    }
}
