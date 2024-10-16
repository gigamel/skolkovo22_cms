<?php declare(strict_types=1);

namespace App\Cms\Frontend\View\Widget;

use App\Cms\Frontend\View\Widget\AbstractWidget;

final class StubWidget extends AbstractWidget
{
    public function render(string $view, array $params = []): string
    {
        return '';
    }
}
