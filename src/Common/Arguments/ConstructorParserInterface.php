<?php declare(strict_types=1);

namespace App\Common\Arguments;

interface ConstructorParserInterface
{
    public function getArguments(string $class): array;
}
