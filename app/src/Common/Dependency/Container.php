<?php

declare(strict_types=1);

namespace App\Common\Dependency;

use App\Framework\Dependency\ContainerInterface;
use ReflectionClass;
use ReflectionMethod;
use ReflectionParameter;

class Container implements ContainerInterface
{
    /** @var array */
    protected $_instances = [];

    /** @var array */
    protected $_dependecies = [];

    /** @var array */
    protected $_parameters = [];

    /**
     * @inheritDoc
     */
    public function set(string $interfaceOrClass, string $class): void
    {
        $this->_dependecies[$interfaceOrClass] = $class;
    }

    /**
     * @inheritDoc
     */
    public function get(string $interfaceOrClass): object
    {
        if (array_key_exists($interfaceOrClass, $this->_instances)) {
            return $this->_instances[$interfaceOrClass];
        }
        
        if (!array_key_exists($interfaceOrClass, $this->_dependecies)) {
            throw new UnknownDependencyException(
                sprintf('Unknown service %s', $interfaceOrClass)
            );
        }

        $reflection = new ReflectionClass($this->_dependecies[$interfaceOrClass]);

        $constructor = $reflection->getConstructor();
        if (is_null($constructor)) {
            $this->_instances[$interfaceOrClass] = $reflection->newInstance();
        } else {
            $this->_instances[$interfaceOrClass] = $reflection->newInstanceArgs(
                $this->parseParameters(
                    $interfaceOrClass,
                    $constructor
                )
            );
        }

        unset($this->_dependecies[$interfaceOrClass]);
        unset($this->_parameters[$interfaceOrClass]);

        return $this->_instances[$interfaceOrClass];
    }

    /**
     * @inheritDoc
     */
    public function has(string $interfaceOrClass): bool
    {
        return array_key_exists($interfaceOrClass, $this->_dependecies)
            || array_key_exists($interfaceOrClass, $this->_instances);
    }

    /**
     * @inheritDoc
     */
    public function import(string $source): void
    {
        if (!file_exists($source)) {
            return;
        }

        $parameters = require_once($source);
        if (is_array($parameters)) {
            $this->_parameters = array_replace_recursive($this->_parameters, $parameters);
        }
    }

    /**
     * @param string $interfaceOrClass
     * @param ReflectionMethod $reflectionMethod
     *
     * @return array
     */
    protected function parseParameters(string $interfaceOrClass, ReflectionMethod $reflectionMethod): array
    {
        $parameters = [];

        foreach ($reflectionMethod->getParameters() as $reflectionParameter) {
            $parameters[$reflectionParameter->getName()] = $this->resolveParameter(
                $interfaceOrClass,
                $reflectionParameter
            );
        }

        return $parameters;
    }

    /**
     * @param string $interfaceOrClass
     * @param ReflectionParameter $reflectionParameter
     *
     * @return mixed
     */
    protected function resolveParameter(string $interfaceOrClass, ReflectionParameter $reflectionParameter): mixed
    {
        if ($reflectionParameter->hasType()) {
            $type = $reflectionParameter->getType()->getName();
            if (class_exists($type) || interface_exists($type)) {
                return $this->get($type);
            }
        }

        $parameter = $this->_parameters[$interfaceOrClass][$reflectionParameter->getName()] ?? null;
        if (is_null($parameter) && $reflectionParameter->isDefaultValueAvailable()) {
            return $reflectionParameter->getDefaultValue();
        }

        return $parameter;
    }
}
