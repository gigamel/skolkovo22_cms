<?php declare(strict_types=1);

namespace App\Module\User;

use App\Common\DI\ContainerInterface;
use App\Common\DI\ProviderInterface;
use App\Module\User\Service\UserRepository;

final class Provider implements ProviderInterface
{
    public function setup(ContainerInterface $container): void
    {
        $container->put(UserRepository::class);
    }
}
