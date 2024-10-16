<?php declare(strict_types=1);

namespace App\Cms\DI;

use App\Common\DI\Container as FrameworkContainer;
use App\Common\DI\ContainerInterface as FrameworkContainerInterface;
use App\Common\DI\Exception as FrameworkContainerException;
use Exception;

final class Container implements ContainerInterface
{
    private FrameworkContainerInterface $container;
    
    public function __construct(?FrameworkContainerInterface $container = null)
    {
        $this->container = $container ?? new FrameworkContainer();
    }
    
    public function importArguments(string $source): void
    {
        $this->container->importArguments($source);
    }
    
    /**
     * @throws Exception
     */
    public function put(string $id, mixed $dependency = null): void
    {
        try {
            $this->container->put($id, $dependency);
        } catch (FrameworkContainerException $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }

    /**
     * @throws Exception
     */
    public function get(string $id): mixed
    {
        try {
            return $this->container->get($id);
        } catch (FrameworkContainerException $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }
    
    public function has(string $id): bool
    {
        return $this->container->has($id);
    }
    
    /**
     * @throws Exception
     */
    public function newInstance(string $class, array $arguments = []): object
    {
        try {
            return $this->container->newInstance($class, $arguments);
        } catch (FrameworkContainerException $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }
}
