<?php

use App\Common\Browser\Url;
use App\Common\Application;
use App\Common\Base\Directory;

Directory::setup(getcwd());

if (0 === strpos(Url::path(), '/admin/')) {
    Url::setUpWebRoot('/admin');


    $router = new \App\Framework\Http\Router([
        'page' => '[1-9]+[0-9]*',
    ]);

    $router->route('pages', '/admin/pages/{page}', function () {
        return 'hello';
    });

    var_dump($router);
    die();


    require_once __DIR__ . '/theme/layout.php';
} else {
    (new Application())->run();
}
