<?php declare(strict_types=1);

namespace App\Common\Loader;

interface ArrayImporterInterface
{
    public function importArrayFrom(string $resource): array;
}
