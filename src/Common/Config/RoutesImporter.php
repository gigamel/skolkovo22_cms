<?php declare(strict_types=1);

namespace App\Common\Config;

use Skolkovo22\Http\Routing\RoutesCollectionInterface;

final class RoutesImporter
{
    public function __construct(private readonly ProjectInterface $project)
    {
    }
    
    public function import(RoutesCollectionInterface $collection): void
    {
        $loader = new \Skolkovo22\Loader\PhpFileArrayImporter();
        
        foreach (
            $loader->importArrayFrom($this->project->getConfigDir() . '/routes.php')
            as $name => $route
        ) {
            $collection->set($name, $route);
        }
        
    }
}
