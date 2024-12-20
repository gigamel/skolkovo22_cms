<?php

declare(strict_types=1);

namespace App\Base\View;

use Gigamel\Frontend\View\RenderableInterface;

interface WidgetInterface extends RenderableInterface
{
    public function getSource(): string;
}

