<?php declare(strict_types=1);

namespace App\Cms\Arguments;

use App\Cms\DI\ContainerInterface;
use Exception;
use ReflectionClass;
use ReflectionException;
use ReflectionMethod;
use ReflectionParameter;

class DIConstructorParser implements ConstructorParserInterface
{
    public function __construct(
        protected ContainerInterface $container
    ) {
    }
    
    public function getArguments(string $class): array
    {
        $reflectionClass = new ReflectionClass($class);
        if (!$constructor = $reflectionClass->getConstructor()) {
            return [];
        }
        
        $this->checkModifiers($constructor);
        
        $arguments = [];
        foreach ($constructor->getParameters() as $reflectionParameter) {
            $arguments[] = $this->parseArgument($reflectionParameter);
        }
        
        return $arguments;
    }
    
    protected function checkModifiers(ReflectionMethod $reflectionMethod): void
    {
        if ($reflectionMethod->isPublic() && !$reflectionMethod->isAbstract()) {
            return;
        }
        
        throw new Exception('Failed parse arguments from action');
    }
    
    protected function parseArgument(ReflectionParameter $reflectionParameter): mixed
    {
        $type = $reflectionParameter->getType()->getName();
        if ($this->container->has($type)) {
            $argument = $this->container->get($type);
        } elseif ($reflectionParameter->isDefaultValueAvailable()) {
            $argument = $reflectionParameter->getDefaultValue();
        }
        
        return $argument ?? null;
    }
}
