<?php declare(strict_types=1);

namespace App\Common\DI;

use Exception;

interface ContainerInterface
{
    /**
     * @throws Exception
     */
    public function put(string $id, mixed $dependency = null): void;

    /**
     * @throws Exception
     */
    public function get(string $id): mixed;
    
    public function has(string $id): bool;
}
