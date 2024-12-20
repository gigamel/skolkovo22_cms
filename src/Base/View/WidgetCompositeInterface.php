<?php

declare(strict_types=1);

namespace App\Base\View;

interface WidgetCompositeInterface
{
    public function build(string $widgetClass): WidgetInterface;
}
