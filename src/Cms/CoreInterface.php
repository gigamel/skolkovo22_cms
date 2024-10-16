<?php declare(strict_types=1);

namespace App\Cms;

use App\Cms\DI\ContainerInterface;

interface CoreInterface
{
    public function getContainer(): ContainerInterface;
    
    public function getConfig(string $option, mixed $default = null): mixed;
}
