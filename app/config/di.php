<?php

use App\Common\Base\Directory;
use App\Framework\Http\Routing\RouterInterface;
use App\Framework\Render\TemplateEngineInterface;
use App\Framework\Storage\ConnectionInterface;

return [
    ConnectionInterface::class => [
        'dsn' => 'mysql:host=mysql;port=3306;dbname=skolkovo22_cms;charset=utf8',
        'username' => 'skolkovo22_cms',
        'password' => '123',
    ],
    RouterInterface::class => [
        'segments' => [
            'id' => '[1-9]+[0-9]*',
            'page' => '[1-9]+[0-9]*',
        ],
    ],
    TemplateEngineInterface::class => [
        'themePath' => Directory::theme(),
    ],
];
