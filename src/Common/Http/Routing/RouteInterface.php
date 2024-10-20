<?php declare(strict_types=1);

namespace App\Common\Http\Routing;

use Sklkv22\Http\Protocol\ClientMessageInterface;

interface RouteInterface
{
    public function getRules(): string;
    
    public function getAction(): ActionInterface;
    
    /**
     * @return list<string>
     */
    public function getMethods(): array;
}
