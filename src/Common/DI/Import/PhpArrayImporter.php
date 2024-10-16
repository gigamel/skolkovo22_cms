<?php declare(strict_types=1);

namespace App\Common\DI\Import;

class PhpArrayImporter implements ImporterInterface
{
    public function import(string $source): array
    {
        if (\str_ends_with($source, '.php') && file_exists($source)) {
            $data = require_once($source);
            return is_array($data) ? $data : [];
        }
        return [];
    }
}
