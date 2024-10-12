<?php declare(strict_types=1);

namespace App\Cms;

use App\Cms\DI\ContainerInterface;

interface CoreInterface
{
    public function getContainer(): ContainerInterface;
    
    public function getAlias(string $alias): string;
    
    public function setAlias(string $alias, string $real): void;
    
    public function getConfig(string $option, mixed $default = null): mixed;
}
