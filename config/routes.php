<?php

use App\Common\Http\Route;

return [
    [
        'home',
        new Route(
            '/',
            '\App\Controller\BlogController',
            'home'
        )
    ],
    [
        'blog_post',
        new Route(
            '/blog/post/{id}',
            '\App\Controller\BlogController',
            'post'
        )
    ],
    [
        'contacts',
        new Route(
            '/contacts/',
            '\App\Controller\PageController',
            'contacts'
        )
    ],
];
