<?php

declare(strict_types=1);

return [
    Gigamel\Frontend\View\RenderCompositeInterface::class => [
        'source' => __DIR__ . '/../view',
    ],
    App\Base\Storage\ConnectionInterface::class => [
        'databasePath' => 'sqlite:' . __DIR__ . '/../var/data/sqlite/app.sqlite',
    ],
];
