<?php declare(strict_types=1);

namespace App\Common\Frontend\View;

interface ViewInterface
{
    public function render(string $view, array $vars = []): string;
}
