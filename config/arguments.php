<?php

use App\Common\Frontend\View\ThemeInterface;

return [
    ThemeInterface::class => [
        'source' => __DIR__ . '/../theme/default',
        'name' => 'theme.php',
        'viewSource' => __DIR__ . '/../view',
    ],
];
