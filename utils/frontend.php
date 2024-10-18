<?php

use App\Common\Arguments\DIConstructorParser;
use App\Common\DI\Container;
use App\Common\Frontend\View\ThemeInterface;
use App\Common\Frontend\View\Widget\Type\StubWidget;
use App\Common\Frontend\View\Widget\WidgetInterface;

if (!function_exists('widget')) {
    function widget(string $name): WidgetInterface
    {
        if (class_exists($name) && is_subclass_of($name, WidgetInterface::class)) {
            return new $name(
                ...array_values((
                    new DIConstructorParser(Container::getInstance())
                )->getArguments($name))
            );
        }
        
        return new StubWidget();
    }
}

if (!function_exists('theme')) {
    function theme(string $view, array $vars = []): string
    {
        return Container::getInstance()->get(ThemeInterface::class)->render($view, $vars);
    }
}
