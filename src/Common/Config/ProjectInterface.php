<?php declare(strict_types=1);

namespace App\Common\Config;

interface ProjectInterface
{
    public function getConfigDir(): string;
}
