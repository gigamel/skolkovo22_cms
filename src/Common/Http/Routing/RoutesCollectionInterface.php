<?php declare(strict_types=1);

namespace App\Common\Http\Routing;

use App\Common\Http\Routing\RouteInterface;
use Exception;

interface RoutesCollectionInterface
{
    public function set(string $name, RouteInterface $route): void;
    
    /**
     * @throws Exception
     */
    public function get(string $name): RouteInterface;
    
    public function has(string $name): bool;
    
    /**
     * @return RouteInterface[]
     */
    public function getCollection(): array;
}
