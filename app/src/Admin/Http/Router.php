<?php

declare(strict_types=1);

namespace App\Admin\Http;

use App\Framework\Http\Router as SkolkovoRouter;

class Router extends SkolkovoRouter
{
    /**
     * @param array $segments
     * @param string $webRoot
     */
    public function __construct(array $segments = [], protected string $webRoot = '')
    {
        parent::__construct($segments);
    }
    
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
            rtrim($this->webRoot, '/') . '/' . ltrim($rule, '/'),
            $controller,
            $action,
            $methods
        );
    }
}
