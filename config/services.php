<?php

declare(strict_types=1);

use App\Http\Router;
use App\Service\Storage\Connection;

return [
    'db.connection' => Connection::class,
    'http.router' => Router::class,
];
