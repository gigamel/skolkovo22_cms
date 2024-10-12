<?php declare(strict_types=1);

namespace App\Cms\Controller;

use App\Cms\DI\ContainerInterface;
use App\Common\Http\Protocol\ClientMessageInterface;
use ReflectionClass;
use ReflectionMethod;

final class ArgumentsParser
{
    public function __construct(
        private ContainerInterface $container,
        private ClientMessageInterface $clientMessage
    ) {
    }
    
    public function getConstructorArguments(string $controller): array
    {
        $reflectionClass = new ReflectionClass($controller);
        if (!$reflectionClass->getConstructor()) {
            return [];
        }
        
        $arguments = [];
        foreach ($reflectionClass->getConstructor()->getParameters() as $reflectionParameter) {
            $type = $reflectionParameter->getType()->getName();
            
            if ($this->container->has($type)) {
                $arguments[] = $this->container->get($type);
            } elseif (is_a($type, ClientMessageInterface::class, true)) {
                $arguments[] = $this->clientMessage;
            }
        }
        return $arguments;
    }
    
    public function getActionArguments(
        string|object $controller,
        string $action
    ): array {
        $reflectionMethod = new ReflectionMethod($controller, $action);
        
        $arguments = [];
        foreach ($reflectionMethod->getParameters() as $reflectionParameter) {
            $type = $reflectionParameter->getType()->getName();
            
            if ($this->container->has($type)) {
                $arguments[] = $this->container->get($type);
            } elseif (is_a($type, ClientMessageInterface::class, true)) {
                $arguments[] = $this->clientMessage;
            } elseif ($this->clientMessage->hasSegment($reflectionParameter->getName())) {
                $arguments[] = $this->clientMessage->getSegment($reflectionParameter->getName());
            } elseif ($reflectionParameter->isDefaultValueAvailable()) {
                $arguments[] = $reflectionParameter->getDefaultValue();
            }
        }
        return $arguments;
    }
}
