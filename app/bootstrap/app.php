<?php

use App\Admin\Application as AdminApplication;
use App\Common\Browser\Url;
use App\Common\Application as CMSApplication;
use App\Common\Base\Directory;

ini_set('display_errors', 1);
error_reporting(E_ALL);

Directory::setup(getcwd());

if (0 === strpos(Url::path(), '/admin/')) {
    Url::setUpWebRoot('/admin');
    (new AdminApplication())->run();
} else {
    (new CMSApplication())->run();
}
