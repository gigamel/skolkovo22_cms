<?php

use App\Common\Frontend\View\ThemeInterface;
use Skolkovo22\Http\Routing\RoutesCollectionInterface;
use Skolkovo22\Http\Routing\RouterInterface;

return [
    RoutesCollectionInterface::class => [],
    RouterInterface::class => [
        'segments' => [
            'id' => '[1-9]{1}[0-9]+?',
            'page' => '[1-9]+[0-9]?',
        ],
    ],
    ThemeInterface::class => [
        'source' => __DIR__ . '/../theme/default',
        'name' => 'theme.php',
        'viewSource' => __DIR__ . '/../view',
    ],
];
