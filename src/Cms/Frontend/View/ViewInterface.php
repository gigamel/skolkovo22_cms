<?php declare(strict_types=1);

namespace App\Cms\Frontend\View;

interface ViewInterface
{
    public function render(string $view, array $params = []): string;
}
