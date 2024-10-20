<?php declare(strict_types=1);

namespace App\Common\Config;

use function file_exists;
use function is_array;
use function str_ends_with;

final class PhpArrayImporter
{
    public function importArrayFrom(string $source): array
    {
        if (str_ends_with($source, '.php') && file_exists($source)) {
            $array = require_once($source);
        }
        return is_array($array ?? null) ? $array : [];
    }
}
