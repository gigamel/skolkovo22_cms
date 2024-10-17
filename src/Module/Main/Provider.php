<?php declare(strict_types=1);

namespace App\Module\Main;

use App\Common\BusinessRules\RulesChecker;
use App\Common\BusinessRules\RulesCheckerInterface;
use App\Common\DI\ContainerInterface;
use App\Common\DI\ProviderInterface;
use Skolkovo22\Http\Router;
use Skolkovo22\Http\RoutesCollection;
use Skolkovo22\Http\Routing\RoutesCollectionInterface;
use Skolkovo22\Http\Routing\RouterInterface;

final class Provider implements ProviderInterface
{
    public function setup(ContainerInterface $container): void
    {
        $container->importArguments(__DIR__ . '/../../../config/arguments.php');
        
        $container->put(RoutesCollectionInterface::class, RoutesCollection::class);
        $container->put(RouterInterface::class, Router::class);
        $container->put(RulesCheckerInterface::class, RulesChecker::class);
    }
}
