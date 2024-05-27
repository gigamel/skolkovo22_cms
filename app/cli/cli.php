<?php

use App\Common\Base\Directory;
use App\Framework\Dependency\ContainerInterface;
use App\Framework\Storage\ConnectionInterface;

require_once __DIR__ . '/../vendor/autoload.php';

Directory::setup(__DIR__ . '/..');

/** @var ContainerInterface $container */
$container = require_once(Directory::config() . '/container.php');
require_once Directory::config() . '/services.php';

$fixtures = [
    Directory::config() . '/../data/user.sql',
];

foreach ($fixtures as $fixture) {
    ob_start();
    require_once Directory::config() . '/../data/user.sql';
    $sql = ob_get_contents();
    ob_end_clean();
    
    $container->get(ConnectionInterface::class)->getConnection()->exec($sql);
}

echo 'fixture has been created' . PHP_EOL;
exit(1);
