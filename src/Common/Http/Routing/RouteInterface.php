<?php declare(strict_types=1);

namespace App\Common\Http\Routing;

interface RouteInterface
{
    public function getRule(): string;
    
    public function getAction(): string;

    /**
     * @return list<string>
     */
    public function getMethods(): array;
}
