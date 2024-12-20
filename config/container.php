<?php

declare(strict_types=1);

return [
    Gigamel\Http\Server\SessionInterface::class => Gigamel\Http\Session::class,
    Gigamel\Frontend\View\RenderCompositeInterface::class => App\Base\Render\RenderComposite::class,
    App\Base\View\WidgetCompositeInterface::class => App\Base\View\WidgetComposite::class,
    App\Base\Storage\ConnectionInterface::class => App\Base\Storage\SqliteConnection::class,
];
