<?php declare(strict_types=1);

namespace App\Cms\Frontend\Widget;

interface WidgetInterface
{
    public function render(string $view, array $params = []): string;
}
