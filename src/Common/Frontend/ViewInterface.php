<?php declare(strict_types=1);

namespace App\Frontend;

interface ViewInterface
{
    public function render(string $template, array $vars = []): string;
}
