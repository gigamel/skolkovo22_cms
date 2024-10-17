<?php declare(strict_types=1);

namespace App\Common\Config;

class Project implements ProjectInterface
{
    public function __construct(
        protected string $root
    ) {
    }
    
    public function getConfigDir(): string
    {
        return sprintf('%s/config', $this->root);
    }
}
