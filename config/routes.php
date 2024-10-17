<?php

use Skolkovo22\Http\Route;

return [
    'blog_list' => new Route(
        '/',
        '\\App\\Controller\\BlogController',
        'posts'
    ),
    'blog_list_page' => new Route(
        '/blog/page/{page}',
        '\\App\\Controller\\BlogController',
        'posts'
    ),
    'blog_post' => new Route(
        '/blog/post/{id}',
        '\\App\\Controller\\BlogController',
        'post'
    ),
    'contacts' => new Route(
        '/contacts/',
        '\\App\\Controller\\PageController',
        'contacts'
    ),
];
