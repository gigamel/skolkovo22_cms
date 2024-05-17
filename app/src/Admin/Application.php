<?php

declare(strict_types=1);

namespace App\Admin;

use App\Admin\Http\Pipeline\ApplicationPipeline;
use App\Admin\Http\Pipeline\AuthMiddleware;
use App\Admin\Http\Router;
use App\Common\Base\Directory;
use App\Common\Dependency\Container;
use App\Common\Http\ExceptionHandler;
use App\Common\Render\TemplateEngine;
use App\Common\Storage\Connection;
use App\Framework\Dependency\ContainerInterface;
use App\Framework\Http\Protocol\ClientMessageInterface;
use App\Framework\Http\Protocol\ServerMessageInterface;
use App\Framework\Http\Request;
use App\Framework\Http\Routing\RouteInterface;
use App\Framework\Http\Routing\RouterInterface;
use App\Framework\Storage\ConnectionInterface;
use Throwable;

class Application
{
    /**
     * @return void
     */
    public function run(): void
    {
        try {
            $this->processApplication();
        } catch (Throwable $e) {
            $this->processThrowable($e);
        }
    }
    
    /**
     * @return void
     *
     * @throws Throwable
     */
    protected function processApplication(): void
    {
        $container = $this->loadDIContainer();

        $router = $this->loadRouter();
        
        $request = new Request();
        $route = $router->handle($request);

        $response = $this->processResponse($request, $route);
        $response->send();
        
        $templateEngine = new TemplateEngine(Directory::theme());
        $templateEngine->setContent($response->getBody());
        $templateEngine->includeTheme('admin');
    }
    
    /**
     * @param ClientMessageInterface $request
     * @param RouteInterface $route
     *
     * @return ServerMessageInterface
     */
    protected function processResponse(ClientMessageInterface $request, RouteInterface $route): ServerMessageInterface
    {
        $request->setAttribute('authorized', 'true');

        $middlewares = [
            new AuthMiddleware(),
        ];

        $pipeline = new ApplicationPipeline($route, $middlewares);
        return $pipeline->handle($request);
    }

    /**
     * @param Throwable $e
     *
     * @return void
     */
    protected function processThrowable(Throwable $e): void
    {
        if ($e instanceof \Exception) {
            $response = (new ExceptionHandler())->handle($e);
            $response->send();
            echo $response->getBody();
        } else {
            echo sprintf('<pre style="padding:15px;background-color:purple;color:#eee;">%s [%s]</pre>', $e->getMessage(), get_class($e));
            echo sprintf('<pre style="padding:15px;background-color:#eee;border:1px solid purple;">%s</pre>', $e->getTraceAsString());
        }
    }
    
    /**
     * @return RouterInterface
     */
    protected function loadRouter(): RouterInterface
    {
        $router = new Router([
            'id'   => '[1-9]+[0-9]*',
            'page' => '[1-9]+[0-9]*',
        ]);

        require_once Directory::config() . '/admin/routes.php';
        return $router;
    }

    /**
     * @return ContainerInterface
     */
    protected function loadDIContainer(): ContainerInterface
    {
        $container = new Container();
        $container->set(ConnectionInterface::class, Connection::class);
        return $container;
    }
}
