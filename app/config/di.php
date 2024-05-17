<?php

use App\Framework\Storage\ConnectionInterface;

return [
    ConnectionInterface::class => [
        'dsn' => 'mysql:host=mysql;port=3306;dbname=skolkovo22_cms;charset=utf8',
        'username' => 'skolkovo22_cms',
        'password' => '123',
    ],
];
