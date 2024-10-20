<?php declare(strict_types=1);

namespace App\Common\Config;

use Sklkv22\Http\Router\CollectionInterface;

final class RoutesImporter
{
    public function __construct(private readonly ProjectInterface $project)
    {
    }
    
    public function import(CollectionInterface $collection): void
    {
        $loader = new PhpArrayImporter();
        
        foreach (
            $loader->importArrayFrom($this->project->getConfigDir() . '/routes.php')
            as $route
        ) {
            $collection->add($route);
        }
        
    }
}
