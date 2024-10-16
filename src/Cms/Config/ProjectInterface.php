<?php declare(strict_types=1);

namespace App\Cms\Config;

interface ProjectInterface
{
    public function getConfigDir(): string;
}
