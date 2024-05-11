<?php

use App\Common\Browser\Url;
use App\Common\Application;
use App\Common\Base\Directory;

Directory::setup(getcwd());

if (0 === strpos(Url::path(), '/admin/')) {
    Url::setUpWebRoot('/admin');

    require_once Directory::config() . '/admin/routes.php';

    require_once __DIR__ . '/theme/layout.php';
} else {
    (new Application())->run();
}
