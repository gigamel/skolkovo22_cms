<?php

declare(strict_types=1);

use App\Common\Dependency\Container;
use App\Common\Base\Directory;

$container = new Container();

/** import parameters */
$container->importParameters(Directory::config() . '/di.php');

return $container;
