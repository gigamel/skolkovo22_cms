<?php

declare(strict_types=1);

use App\Cms;
use App\Common\Config\Project;

require_once __DIR__ . '/../vendor/autoload.php';

(new Cms(new Project(dirname(__DIR__))))->run();
