<?php declare(strict_types=1);

namespace App\Common\Config;

use App\Common\DI\ContainerInterface;
use App\Common\DI\ProviderInterface;

final class ProviderImporter
{
    public function __construct(private readonly ProjectInterface $project)
    {
    }
    
    public function import(ContainerInterface $container): void
    {
        $loader = new PhpArrayImporter();
        
        foreach (
            $loader->importArrayFrom($this->project->getConfigDir() . '/modules.php')
            as $provider
        ) {
            if ($this->isCorrectProviderInterface($provider)) {
                (new $provider())->setup($container);
            }
        }
    }
    
    private function isCorrectProviderInterface(string $class): bool
    {
        return class_exists($class) && is_subclass_of($class, ProviderInterface::class);
    }
}
