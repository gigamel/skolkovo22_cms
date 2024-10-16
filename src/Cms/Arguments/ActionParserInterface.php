<?php declare(strict_types=1);

namespace App\Cms\Arguments;

interface ActionParserInterface
{
    public function getArguments(string $class, string $action): array;
}
