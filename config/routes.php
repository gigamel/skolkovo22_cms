<?php

use Sklkv22\Http\Router\Route;

return [
    new Route(
        'blog_list',
        '/',
        '\\App\\Controller\\Blog\\PostsController'
    ),
    new Route(
        'blog_list_page',
        '/blog/page/{page}',
        '\\App\\Controller\\Blog\\PostsController',
        [
            'id' => '[1-9]{1}[0-9]+?',
            'page' => '[1-9]+[0-9]?',
        ]
    ),
    new Route(
        'blog_post',
        '/blog/post/{id}',
        '\\App\\Controller\\Blog\\PostController',
        [
            'id' => '[1-9]{1}[0-9]+?',
            'page' => '[1-9]+[0-9]?',
        ]
    ),
    new Route(
        'contacts',
        '/contacts/',
        '\\App\\Controller\\ContactsController'
    ),
];
