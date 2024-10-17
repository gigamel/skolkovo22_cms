<?php

use Skolkovo22\Http\Router;
use Skolkovo22\Http\RoutesCollection;
use Skolkovo22\Http\Routing\RoutesCollectionInterface;
use Skolkovo22\Http\Routing\RouterInterface;

return [
    RoutesCollectionInterface::class => [],
    RouterInterface::class => [
        'segments' => [
            'id' => '[1-9]+[0-9]?',
            'page' => '[1-9]+[0-9]?',
        ],
    ],
];
