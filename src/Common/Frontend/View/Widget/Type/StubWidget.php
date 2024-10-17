<?php declare(strict_types=1);

namespace App\Common\Frontend\View\Widget;

use App\Common\Frontend\View\Widget\AbstractWidget;

final class StubWidget extends AbstractWidget
{
    public function render(string $view, array $params = []): string
    {
        return '';
    }
}
