<?php

declare(strict_types=1);

namespace App\Base\Import;

use Gigamel\Import\PhpArrayImporter as FrameworkPhpArrayImporter;

final class PhpArrayImporter extends FrameworkPhpArrayImporter
{
    public function __construct(
        protected string $source
    ) {
    }

    public function import(string $file): array
    {
        return parent::import($this->source . '/' . $file);
    }
}
