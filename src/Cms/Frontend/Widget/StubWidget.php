<?php declare(strict_types=1);

namespace App\Cms\Frontend\Widget;

final class StubWidget extends AbstractWidget
{
    public function render(string $view, array $params = []): string
    {
        return '';
    }
}
