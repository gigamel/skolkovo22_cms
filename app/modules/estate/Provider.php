<?php

declare(strict_types=1);

namespace modules\estate;

use App\Admin\Provider\RoutesProviderInterface;
use App\Framework\Http\Protocol\ClientMessageInterface;
use modules\estate\src\controller\admin\CategoryController;
use modules\estate\src\controller\admin\EstateController;
use Skolkovo22\Http\Routing\RouterInterface;

class Provider implements RoutesProviderInterface
{
    /**
     * @inheritDoc
     */
    public function setupRoutes(RouterInterface $router): void
    {
        $router->route(
            'estates',
            '/estates/page/{page}',
            EstateController::class,
            'list',
            [ClientMessageInterface::METHOD_GET]
        );
        
        $router->route(
            'estates.edit',
            '/estates/edit/{id}',
            EstateController::class,
            'show',
            [ClientMessageInterface::METHOD_GET, ClientMessageInterface::METHOD_POST]
        );
        
        $router->route(
            'estates.add',
            '/estates/add/',
            EstateController::class,
            'add',
            [ClientMessageInterface::METHOD_GET, ClientMessageInterface::METHOD_POST]
        );
        
        $router->route(
            'estates.delete',
            '/estates/delete/{id}',
            EstateController::class,
            'delete',
            [ClientMessageInterface::METHOD_GET, ClientMessageInterface::METHOD_POST]
        );
        
        $router->route(
            'estates.categories',
            '/estates/categories/page/{page}',
            CategoryController::class,
            'list',
            [ClientMessageInterface::METHOD_GET]
        );
        
        $router->route(
            'estates.category.add',
            '/estates/category/add/',
            CategoryController::class,
            'add',
            [ClientMessageInterface::METHOD_GET, ClientMessageInterface::METHOD_POST]
        );
        
        $router->route(
            'estates.category.edit',
            '/estates/category/edit/{id}',
            CategoryController::class,
            'show',
            [ClientMessageInterface::METHOD_GET, ClientMessageInterface::METHOD_POST]
        );
        
        $router->route(
            'estates.category.delete',
            '/estates/category/delete/{id}',
            CategoryController::class,
            'delete',
            [ClientMessageInterface::METHOD_GET, ClientMessageInterface::METHOD_POST]
        );
    }
}
