<?php declare(strict_types=1);

namespace App\Common\Frontend\Assets;

abstract class AbstractCollection
{
    private array $collection = [];
    
    public function add(string $name, string $file, array $attrs = []): void
    {
        $name = strtolower(trim($name));
        if (empty($name)) {
            return;
        }
        
        $this->collection[$name][$file] = $attrs;
    }
    
    public function getCollection(string $name): array
    {
        return $this->collection[$name] ?? [];
    }
}
