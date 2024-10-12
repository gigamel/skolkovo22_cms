<?php declare(strict_types=1);

namespace App\Cms;

use App\Cms\Config\Alias;
use App\Cms\DI\Container;
use App\Cms\DI\ContainerInterface;

class Core implements CoreInterface
{
    private ContainerInterface $container;
    
    private Alias $alias;
    
    public function __construct()
    {
        $this->container = new Container();
        $this->alias = new Alias();
    }
    
    public function getContainer(): ContainerInterface
    {
        return $this->container;
    }
    
    public function getAlias(string $alias): string
    {
        return $this->alias->get($alias);
    }
    
    public function setAlias(string $alias, string $real): void
    {
        $this->alias->set($alias, $real);
    }
    
    public function getConfig(string $option, mixed $default = null): mixed
    {
        return null; // Todo
    }
}
