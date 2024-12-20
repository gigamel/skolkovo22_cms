<?php

declare(strict_types=1);

namespace App\Base\Service;

use Gigamel\DI\ContainerInterface;

interface ContainerableInterface
{
    public function setupContainer(ContainerInterface $container): void;
}
