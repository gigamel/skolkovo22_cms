<?php

declare(strict_types=1);

namespace App\Framework\Http\Routing;

interface RouteInterface
{
    /**
     * @return string[]
     */
    public function getMethods(): array;
    
    /**
     * @return string
     */
    public function getRule(): string;
    
    /**
     * @return mixed
     */
    public function getAction(): mixed;
}
