<?php

use App\Common\Http\Router;
use App\Common\Http\RoutesCollection;
use App\Common\Http\Routing\RoutesCollectionInterface;
use App\Common\Http\Routing\RouterInterface;

return [
    RoutesCollectionInterface::class => [],
    RouterInterface::class => [
        'segments' => [
            'id' => '[1-9]+[0-9]?',
            'page' => '[1-9]+[0-9]?',
        ],
    ],
];
