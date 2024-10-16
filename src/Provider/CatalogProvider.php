<?php declare(strict_types=1);

namespace App\Provider;

use App\Cms\DI\ContainerInterface;
use App\Cms\DI\ProviderInterface;
use App\Service\Catalog\ProductRepository;

final class CatalogProvider implements ProviderInterface
{
    public function setup(ContainerInterface $container): void
    {   
        $container->put(ProductRepository::class);
    }
}