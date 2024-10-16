<?php declare(strict_types=1);

namespace App\Cms;

use App\Cms\Config\Alias;
use App\Cms\DI\Container;
use App\Cms\DI\ContainerInterface;

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
