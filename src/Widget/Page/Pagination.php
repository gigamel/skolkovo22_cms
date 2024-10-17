<?php declare(strict_types=1);

namespace App\Widget\Page;

use App\Common\Frontend\View\Widget\Type\AbstractPhpWidget;

final class Pagination extends AbstractPhpWidget
{
    protected function getSource(): string
    {
        return __DIR__ . '/view';
    }
}
