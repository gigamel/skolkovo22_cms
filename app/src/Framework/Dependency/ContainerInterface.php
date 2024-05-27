<?php

namespace App\Framework\Dependency;

interface ContainerInterface
{
    /**
     * @param string $interfaceOrClass
     * @param string $class
     *
     * @return void
     */
    public function set(string $interfaceOrClass, string $class): void;
    
    /**
     * @param string $interfaceOrClass
     *
     * @return object
     *
     * @throws UnknownDependencyException
     */
    public function get(string $interfaceOrClass): object;
    
    /**
     * @param string $interfaceOrClass
     *
     * @return bool
     */
    public function has(string $interfaceOrClass): bool;

    /**
     * @param string $source
     *
     * @return void
     */
    public function importParameters(string $source): void;
}
