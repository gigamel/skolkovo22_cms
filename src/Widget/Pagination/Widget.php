<?php

declare(strict_types=1);

namespace App\Widget\Pagination;

use App\Base\View\AbstractWidget;

final class Widget extends AbstractWidget
{
    public function getSource(): string
    {
        return __DIR__ . '/view';
    }
}

