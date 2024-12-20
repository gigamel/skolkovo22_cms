<?php

declare(strict_types=1);

namespace App\Base\View;

final class WidgetComposite implements WidgetCompositeInterface
{
    public function build(string $widgetClass): WidgetInterface
    {
        if (class_exists($widgetClass) && is_a($widgetClass, WidgetInterface::class, true)) {
            return new $widgetClass();
        }

        return new StubWidget();
    }
}
