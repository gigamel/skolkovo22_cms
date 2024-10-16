<?php

use App\Cms\Frontend\View\PhpView;
use App\Cms\Frontend\Widget\StubWidget;
use App\Cms\Frontend\Widget\WidgetInterface;

if (!function_exists('widget')) {
    function widget(string $name): WidgetInterface
    {
        if (class_exists($name) && is_subclass_of($name, WidgetInterface::class)) {
            return new $name();
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