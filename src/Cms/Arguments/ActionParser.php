<?php declare(strict_types=1);

namespace App\Cms\Arguments;

use App\Cms\DI\ContainerInterface;
use App\Common\Http\Protocol\ClientMessageInterface;
use Exception;
use ReflectionException;
use ReflectionMethod;
use ReflectionParameter;

class ActionParser implements ActionParserInterface
{
    public function __construct(
        protected ContainerInterface $container,
        protected ClientMessageInterface $clientMessage
    ) {
    }
    
    public function getArguments(string $class, string $action): array
    {
        $reflectionMethod = new ReflectionMethod($class, $action);
        
        $this->checkModifiers($reflectionMethod->getDeclaringClass()->getConstructor());
        $this->checkModifiers($reflectionMethod);
        
        $arguments = [];
        foreach ($reflectionMethod->getParameters() as $reflectionParameter) {
            $arguments[] = $this->parseArgument($reflectionParameter);
        }
        
        return $arguments;
    }
    
    protected function checkModifiers(?ReflectionMethod $reflectionMethod = null): void
    {
        if (null === $reflectionMethod) {
            return;
        }
        
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
        } elseif (is_a($type, ClientMessageInterface::class, true)) {
            $argument = $this->clientMessage;
        } elseif ($this->clientMessage->hasSegment($reflectionParameter->getName())) {
            $argument = $this->clientMessage->getSegment($reflectionParameter->getName());
        } elseif ($reflectionParameter->isDefaultValueAvailable()) {
            $argument = $reflectionParameter->getDefaultValue();
        }
        
        return $argument ?? null;
    }
}
