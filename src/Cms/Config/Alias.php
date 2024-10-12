<?php declare(strict_types=1);

namespace App\Cms\Config;

final class Alias
{
    private array $aliases = [];
    
    public function set(string $alias, string $real): void
    {
        if ($this->has($alias)) {
            $this->aliases[$alias] = $real;
        }
    }
    
    public function get(string $alias): string
    {
        if (!$this->has($alias)) {
            return $alias;
        }
        
        foreach ($this->aliases as $_alias => $real) {
            $alias = str_replace($_alias, $real, $alias);
            
            if (!$this->has($alias)) {
                break;
            }
        }
        
        return $alias;
    }
    
    public function has(string $alias): bool
    {
        return false !== str_contains($value, '@');
    }
}
