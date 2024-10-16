<?php declare(strict_types=1);

namespace App\Cms\Arguments;

interface ConstructorParserInterface
{
    public function getArguments(string $class): array;
}
