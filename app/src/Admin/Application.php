<?php

declare(strict_types=1);

namespace App\Admin;

use App\Admin\Http\Pipeline\ApplicationPipeline;
use App\Admin\Http\Pipeline\AuthMiddleware;
use App\Common\Base\Directory;
use App\Common\Http\ThrowableHandler;
use App\Common\Render\TemplateEngine;
use App\Framework\Dependency\ContainerInterface;
use App\Framework\Http\Protocol\ClientMessageInterface;
use App\Framework\Http\Protocol\ServerMessageInterface;
use App\Framework\Http\Request;
use App\Framework\Http\Routing\RouteInterface;
use App\Framework\Http\Routing\RouterInterface;
use Throwable;

class Application
{
    /** @var ClientMessageInterface */
    protected $httpRequest;

    /**
     * @return void
     */
    public function run(): void
    {
        $this->httpRequest = new Request();

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
        $this->setCommonDependencies($container);

        $this->loadRoutes($container);
        $route = $container->get(RouterInterface::class)->handle($this->httpRequest);

        $response = $this->processResponse($route);
        $response->send();

        $templateEngine = new TemplateEngine(Directory::theme());
        $templateEngine->setContent($response->getBody());
        $templateEngine->includeTheme('admin_light');
    }
    
    /**
     * @param RouteInterface $route
     *
     * @return ServerMessageInterface
     */
    protected function processResponse(RouteInterface $route): ServerMessageInterface
    {
        $this->httpRequest->setAttribute('authorized', 'true');

        $middlewares = [
            new AuthMiddleware(),
        ];

        $pipeline = new ApplicationPipeline($route, $middlewares);
        return $pipeline->handle($this->httpRequest);
    }

    /**
     * @param Throwable $e
     *
     * @return void
     */
    protected function processThrowable(Throwable $e): void
    {
        (new ThrowableHandler())->handle($e);
    }
    
    /**
     * @param ContainerInterface $container
     *
     * @return void
     */
    protected function loadRoutes(ContainerInterface $container): void
    {
        require_once Directory::config() . '/admin/routes.php';
    }

    /**
     * @return ContainerInterface
     */
    protected function loadDIContainer(): ContainerInterface
    {
        return require_once(Directory::config() . '/container.php');
    }

    /**
     * @param ContainerInterface $container
     *
     * @return void
     */
    protected function setCommonDependencies(ContainerInterface $container): void
    {
        require_once Directory::config() . '/services.php';
    }
}
