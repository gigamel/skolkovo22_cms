<?php declare(strict_types=1);

namespace App\Cms\DI;

use App\Common\DI\Container as FrameworkContainer;
use ReflectionClass;

final class Container extends FrameworkContainer implements ContainerInterface
{
    private array $arguments = [];
    
    public function importArguments(string $source): void
    {
        if (!file_exists($source)) {
            return;
        }
        
        $arguments = require_once($source);
        if (!is_array($arguments)) {
            return;
        }
        
        $this->arguments = array_replace_recursive(
            $this->arguments,
            $arguments
        );
    }
    
    /**
     * @inheritDoc
     */
    public function put(string $id, mixed $dependency = null): void
    {
        if (null === $dependency) {
            if (!class_exists($id)) {
                throw new Exception(
                    'ID should be type of class when Dependency NULL',
                );
            }
            
            $dependency = $id;
        }

        parent::put($id, $dependency);
    }
    
    /**
     * @inheritDoc
     */
    public function get(string $id): mixed
    {
        $dependency = parent::get($id);
        if (!is_string($dependency) && !class_exists($dependency)) {
            return $dependency;
        }
        
        $reflectionClass = new ReflectionClass($dependency);
        if (!$constructor = $reflectionClass->getConstructor()) {
            return $this->dependencies[$id] = $reflectionClass->newInstance();
        }
        
        $arguments = [];
        foreach ($constructor->getParameters() as $reflectionParameter) {
            $type = $reflectionParameter->getType()->getName();
            if (is_string($type) && $this->has($type)) {
                $arguments[] = $this->get($type);
            } elseif (array_key_exists($reflectionParameter->getName(), $this->arguments[$type] ?? [])) {
                $arguments[] = $this->arguments[$type][$reflectionParameter->getName()];
            } elseif ($reflectionParameter->isDefaultValueAvailable()) {
                $arguments[] = $reflectionParameter->getDefaultValue();
            }
        }
        
        return $this->dependencies[$id] = $reflectionClass->newInstanceArgs($arguments);
    }
}
