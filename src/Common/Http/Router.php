<?php declare(strict_types=1);

namespace App\Common\Http;

use App\Common\Http\Routing\RouterInterface;
use Skolkovo22\Http\Protocol\ClientMessageInterface;
use Skolkovo22\Http\Router;
use Skolkovo22\Http\RouterInterface;

class Router implements RouterInterface
{
    protected RouterInterface $router;
    
    public function __construct(protected RouterInterface $router)
    {
    }
    
    public function handleClientMessage(ClientMessageInterface $clientMessage): ActionInterface
    {
        
    }
}