<?php declare(strict_types=1);

namespace App\Module\Blog;

use App\Common\DI\ContainerInterface;
use App\Common\DI\ProviderInterface;
use App\Module\Blog\Service\PostRepository;

final class Provider implements ProviderInterface
{
    public function setup(ContainerInterface $container): void
    {   
        $container->put(PostRepository::class);
    }
}
