<?php declare(strict_types=1);

namespace App\Common\Arguments;

use App\Common\DI\ContainerInterface;
use Skolkovo22\Http\Protocol\ClientMessageInterface;
use Exception;
use ReflectionClass;
use ReflectionException;
use ReflectionMethod;
use ReflectionParameter;

class ConstructorParser extends DIConstructorParser
{
    public function __construct(
        protected ContainerInterface $container,
        protected ClientMessageInterface $clientMessage
    ) {
        parent::__construct($container);
    }
    
    protected function parseArgument(ReflectionParameter $reflectionParameter): mixed
    {
        $argument = parent::parseArgument($reflectionParameter);
        if (null === $argument) {
            if (
                is_a(
                    $reflectionParameter->getType()->getName(),
                    ClientMessageInterface::class,
                    true
                )
            ) {
                $argument = $this->clientMessage;
            }
        }
        return $argument;
    }
}
