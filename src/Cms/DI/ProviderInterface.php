<?php declare(strict_types=1);

namespace App\Cms\DI;

interface ProviderInterface
{
    public function setup(ContainerInterface $container): void;
}
