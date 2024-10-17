<?php

use App\Common\Arguments\DIConstructorParser;
use App\Common\DI\Container;
use App\Common\Frontend\View\Type\PhpView;
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

if (!function_exists('render')) {
    function render(string $view, array $vars = []): string
    {
        return (new PhpView(__DIR__ . '/../view'))->render($view, $vars);
    }
}
