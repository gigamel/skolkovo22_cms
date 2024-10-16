<?php declare(strict_types=1);

namespace App\Widget\Page;

use App\Cms\Frontend\View\Widget\Type\AbstractPhpWidget;

final class Pagination extends AbstractPhpWidget
{
    protected function getSource(): string
    {
        return __DIR__ . '/view';
    }
}
