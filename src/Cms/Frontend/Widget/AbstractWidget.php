<?php declare(strict_types=1);

namespace App\Cms\Frontend\Widget;

abstract class AbstractWidget implements WidgetInterface
{
    public function __call(string $name, array $arguments): mixed
    {
        return $this;
    }
}
