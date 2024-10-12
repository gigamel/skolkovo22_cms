<?php declare(strict_types=1);

namespace App\Common\DI;

use Exception;

class Container implements ContainerInterface
{
    protected array $dependencies = [];

    /**
     * @throws Exception
     */
    public function put(string $id, mixed $dependency = null): void
    {
        if ($this->has($id)) {
            throw new Exception(
                sprintf('Dependency [%s] already exists', $id)
            );
        }

        $this->dependencies[$id] = $dependency;
    }

    /**
     * @throws Exception
     */
    public function get(string $id): mixed
    {
        if (!$this->has($id)) {
            throw new Exception(
                sprintf('Unknown dependency [%s]', $id)
            );
        }
        
        return $this->dependencies[$id];
    }
    
    public function has(string $id): bool
    {
        return array_key_exists($id, $this->dependencies);
    }
}
