<?php

declare(strict_types=1);

use Gigamel\Http\Route;

return [
    new Route(
        'admin_dashboard',
        '/admin/',
        App\Controller\Admin\DashboardController::class,
    ),
    new Route(
        'admin_complexes_list',
        '/admin/complexes/(page/{page})?',
        App\Controller\Admin\Complexe\ListController::class,
        [
            'page' => '[1-9]{1}[0-9]?',
        ]
    ),
    new Route(
        'admin_complexes_edit',
        '/admin/complex/edit/{id}',
        App\Controller\Admin\Complexe\EditController::class,
        [
            'id' => '[1-9]{1}[0-9]?',
        ]
    ),
    new Route(
        'page',
        '/',
        App\Controller\PageController::class,
        [
            'segments' => '.*',
        ]
    ),
];
