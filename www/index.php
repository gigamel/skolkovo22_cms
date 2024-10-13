<?php

declare(strict_types=1);

use App\Cms;

require_once __DIR__ . '/../vendor/autoload.php';

(new Cms())->run();
