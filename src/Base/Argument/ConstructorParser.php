<?php

declare(strict_types=1);

namespace App\Base\Argument;

use Gigamel\DI\ContainerInterface;
use Gigamel\Argument\ConstructorParserInterface;
use InvalidArgumentException;
use ReflectionClass;

use function array_values;
use function class_exists;

final class ConstructorParser implements ConstructorParserInterface
{
    public function __construct(
        private readonly ContainerInterface $container
    ) {
    }

    public function getArguments(string $class): array
    {
        if (!class_exists($class)) {
            throw new InvalidArgumentException(sprintf(
                'Class [%s] does not exists',
                $class
            ));
        }

        $reflectionClass = new ReflectionClass($class);
        if (!$constructor = $reflectionClass->getConstructor()) {
            return [];
        }

        if ($constructor->isAbstract() || !$constructor->isPublic()) {
            throw new InvalidArgumentException(sprintf(
                'Constructor of [%s] must be public',
                $class
            ));
        }

        $arguments = [];

        foreach ($constructor->getParameters() as $reflectionParameter) {
            $type = $reflectionParameter->getType()->getName();

            if ($this->container->has($type)) {
                $arguments[] = $this->container->get($type);
            } elseif (class_exists($type)) {
                $arguments[] = new $type(...array_values($this->getArguments($type)));
            }
        }

        return $arguments;
    }
}
