<?php

declare(strict_types=1);

namespace App\Admin;

use App\Common\Base\Directory;
use App\Common\Http\ThrowableHandler;
use App\Framework\Dependency\ContainerInterface;
use App\Framework\Http\NotFoundException;
use App\Framework\Http\Protocol\ClientMessageInterface;
use App\Framework\Http\Protocol\ServerMessageInterface;
use App\Framework\Http\Request;
use App\Framework\Http\Routing\RouteInterface;
use App\Framework\Http\Routing\RouteNotFoundException;
use App\Framework\Http\Routing\RouterInterface;
use App\Framework\Render\TemplateEngineInterface;
use ReflectionClass;
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
        $this->loadModules($container);

        try {
            $route = $container->get(RouterInterface::class)->handle($this->httpRequest);
        } catch (RouteNotFoundException $e) {
            throw new NotFoundException('Unknown resource');
        }

        $response = $this->processResponse($route, $container);
        $response->send();

        $container->get(TemplateEngineInterface::class)->setContent($response->getBody());
        $container->get(TemplateEngineInterface::class)->includeTheme('admin_light');
    }
    
    /**
     * @param RouteInterface $route
     * @param ContainerInterface $container
     *
     * @return ServerMessageInterface
     *
     * @throws \ReflectionException
     */
    protected function processResponse(RouteInterface $route, ContainerInterface $container): ServerMessageInterface
    {
        $reflection = new ReflectionClass($route->getController());

        $constructor = $reflection->getConstructor();
        if (is_null($constructor)) {
            $controller = $reflection->newInstance();
        } else {
            $constructorArgs = [];
            foreach ($constructor->getParameters() as $reflectionParameter) {
                $constructorArgs[] = $container->get($reflectionParameter->getType()->getName());
            }

            $controller = $reflection->newInstanceArgs($constructorArgs);
        }

        return $controller->{$route->getAction()}($this->httpRequest);
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

    /**
     * @param ContainerInterface $container
     *
     * @return void
     */
    protected function loadModules(ContainerInterface $container): void
    {
        $provider = 'modules\\%s\\Provider';

        $modules = require_once(Directory::config() . '/modules.php');
        foreach ($modules as $module) {
            $providerClass = sprintf($provider, $module);
            if (!class_exists($providerClass)) {
                continue;
            }

            $providerInstance = new $providerClass();
            $providerInstance->setupRoutes($container->get(RouterInterface::class));
        }
    }
}
