<?php

declare(strict_types=1);

use App\Cms\Config\Project;
use App\Cms\Skolkovo22;

require_once __DIR__ . '/../vendor/autoload.php';

(new Skolkovo22(new Project(dirname(__DIR__))))->run();
