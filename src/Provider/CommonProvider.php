<?php declare(strict_types=1);

namespace App\Provider;

use App\Cms\BusinessRules\RulesChecker;
use App\Cms\BusinessRules\RulesCheckerInterface;
use App\Cms\DI\ContainerInterface;
use App\Cms\DI\ProviderInterface;
use App\Common\Http\Router;
use App\Common\Http\RoutesCollection;
use App\Common\Http\Routing\RoutesCollectionInterface;
use App\Common\Http\Routing\RouterInterface;

final class CommonProvider implements ProviderInterface
{
    public function setup(ContainerInterface $container): void
    {
        $container->importArguments(__DIR__ . '/../../config/arguments.php');
        
        $container->put(RoutesCollectionInterface::class, RoutesCollection::class);
        $container->put(RouterInterface::class, Router::class);
        $container->put(RulesCheckerInterface::class, RulesChecker::class);
    }
}
