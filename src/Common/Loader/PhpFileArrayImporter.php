<?php declare(strict_types=1);

namespace App\Common\Loader;

class PhpFileArrayImporter implements ArrayImporterInterface
{
    public function importArrayFrom(string $resource): array
    {
        if (!file_exists($resource)) {
            return [];
        }

        $arguments = require_once($resource);
        return is_array($arguments) ? $arguments : [];
    }
}
