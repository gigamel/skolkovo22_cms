<?php declare(strict_types=1);

namespace App\Module\Magazine;

use App\Common\DI\ContainerInterface;
use App\Common\DI\ProviderInterface;
use App\Module\Magazine\Service\CartRepository;
use App\Module\Magazine\Service\ProductRepository;

final class Provider implements ProviderInterface
{
    public function setup(ContainerInterface $container): void
    {
        $container->put(CartRepository::class);
        $container->put(ProductRepository::class);
    }
}
