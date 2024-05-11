<?php

declare(strict_types=1);

use App\Admin\Controller\Estate\EstatesController;
use App\Framework\Http\Protocol\ClientMessageInterface;
use App\Framework\Http\Router;

$router = new Router([
    'page' => '[1-9]+[0-9]*',
]);

$router->route('estates','/admin/estates/', [EstatesController::class, 'list'], [ClientMessageInterface::METHOD_GET]);
