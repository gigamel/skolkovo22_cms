<?php declare(strict_types=1);

namespace App\Common;

use App\Common\BusinessRules\RulesChecker;
use App\Common\BusinessRules\RulesCheckerInterface;
use App\Common\DI\ContainerInterface;
use App\Common\DI\ProviderInterface;
use App\Common\Frontend\View\Theme\PhpTheme;
use App\Common\Frontend\View\ThemeInterface;
use Sklkv22\Http\Router\Router;
use Sklkv22\Http\Router\Collection;
use Sklkv22\Http\Router\CollectionInterface;
use Sklkv22\Http\Router\RouterInterface;

final class Provider implements ProviderInterface
{
    public function setup(ContainerInterface $container): void
    {
        $container->importArguments(__DIR__ . '/../../config/arguments.php');
        
        $container->put(CollectionInterface::class, Collection::class);
        $container->put(RouterInterface::class, Router::class);
        $container->put(RulesCheckerInterface::class, RulesChecker::class);
        $container->put(ThemeInterface::class, PhpTheme::class);
    }
}
