<?php declare(strict_types=1);

namespace App\Common\DI;

use Skolkovo22\DI\Container as FrameworkContainer;
use Skolkovo22\DI\ContainerInterface as FrameworkContainerInterface;
use Skolkovo22\DI\Exception as FrameworkContainerException;
use Exception;

final class Container implements ContainerInterface
{
    private static ContainerInterface $instance;
    
    private FrameworkContainerInterface $container;
    
    public function __construct(?FrameworkContainerInterface $container = null)
    {
        $this->container = $container ?? new FrameworkContainer();
        self::$instance ??= $this;
    }
    
    public static function getInstance(): self
    {
        return self::$instance;
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
