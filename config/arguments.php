<?php

use App\Http\Routing\RouterInterface;
use App\Storage\ConnectionInterface;

return [
    ConnectionInterface::class => [
        'dsn' => 'mysql',
        'username' => 'admin',
        'password' => '123',
    ],
    RouterInterface::class => [
        'segments' => [
            'id' => 'd+',
        ],
    ],
];
