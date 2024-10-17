<?php declare(strict_types=1);

namespace App\Common;

use App\Common\Config\Alias;
use App\Common\DI\Container;
use App\Common\DI\ContainerInterface;

class Core implements CoreInterface
{
    private ContainerInterface $container;
    
    public function __construct()
    {
        $this->container = new Container();
    }
    
    public function getContainer(): ContainerInterface
    {
        return $this->container;
    }
    
    public function getConfig(string $option, mixed $default = null): mixed
    {
        return null; // Todo
    }
}
