<?php declare(strict_types=1);

namespace App\Common\Loader;

interface ImporterInterface
{
    public function importFrom(string $resource): void;
}
