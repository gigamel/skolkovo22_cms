<?php declare(strict_types=1);

namespace App\Common\DI\Import;

interface ImporterInterface
{
    public function import(string $source): array;
}
