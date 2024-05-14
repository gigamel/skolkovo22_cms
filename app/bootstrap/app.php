<?php

use App\Admin\Application as AdminApplication;
use App\Common\Browser\Url;
use App\Common\Application as CMSApplication;
use App\Common\Base\Directory;

Directory::setup(getcwd());

if (0 === strpos(Url::path(), '/admin/')) {
    Url::setUpWebRoot('/admin');
    (new AdminApplication())->run();
} else {
    (new CMSApplication())->run();
}
