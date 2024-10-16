<?php declare(strict_types=1);

namespace App\Common\DI;

use Exception;

interface ContainerInterface
{
    public static function getInstance(): self;
    
    public function importArguments(string $source): void;
    
    /**
     * @throws Exception
     */
    public function put(string $id, mixed $dependency = null): void;

    /**
     * @throws Exception
     */
    public function get(string $id): mixed;
    
    public function has(string $id): bool;
    
    /**
     * @throws Exception
     */
    public function newInstance(string $class, array $arguments = []): object;
}
