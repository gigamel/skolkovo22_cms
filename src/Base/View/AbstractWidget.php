<?php

declare(strict_types=1);

namespace App\Base\View;

use Gigamel\Frontend\View\Driver\PhpRenderDriver;
use Gigamel\Frontend\View\RenderableInterface;

abstract class AbstractWidget implements WidgetInterface
{
    public function render(string $view, array $vars = []): string
    {
        return (new PhpRenderDriver())->render($this->getSource() . '/' . $view, $vars);
    }
}
