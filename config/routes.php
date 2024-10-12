<?php

use App\Common\Http\Route;
use App\Common\Http\RoutesCollection;

$collection = new RoutesCollection();

$collection->set(
    'home',
    new Route(
        '/',
        '\App\Controller\BlogController::home'
    )
);

$collection->set(
    'blog_post',
    new Route(
        '/blog/post/{id}',
        '\App\Controller\BlogController::post'
    )
);

$collection->set(
    'contacts',
    new Route(
        '/contacts/',
        '\App\Controller\PageController::contacts'
    )
);

return $collection;
