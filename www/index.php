<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/vendor/autoload.php';

use App\Estates;

(new Estates(dirname(__DIR__)))->run();
