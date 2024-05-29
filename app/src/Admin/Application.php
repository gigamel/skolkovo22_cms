<?php

declare(strict_types=1);

namespace App\Admin;

use App\Admin\Provider\EventsProviderInterface;
use App\Admin\Provider\RoutesProviderInterface;
use App\Common\Base\Directory;
use App\Common\Http\ThrowableHandler;
use App\Framework\Dependency\ContainerInterface;
use App\Framework\EventsListener\EventsListenerInterface;
use App\Framework\Http\NotFoundException;
use App\Framework\Http\Routing\RouteNotFoundException;
use App\Framework\Render\TemplateEngineInterface;
use ReflectionClass;
use Skolkovo22\Http\Protocol\ClientMessageInterface;
use Skolkovo22\Http\Protocol\ServerMessageInterface;
use Skolkovo22\Http\Request;
use Skolkovo22\Http\Routing\RouterInterface;
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
        $this->processRouter($container);

        $response = $this->processResponse($container);
        $response->send();

        $container->get(TemplateEngineInterface::class)->setContent($response->getBody());
        $container->get(TemplateEngineInterface::class)->includeTheme('admin_light');
    }

    /**
     * @param ContainerInterface $container
     *
     * @return void
     */
    protected function processRouter(ContainerInterface $container): void
    {
        try {
            $route = $container->get(RouterInterface::class)->handle($this->httpRequest);
        } catch (RouteNotFoundException $e) {
            throw new NotFoundException('Unknown resource');
        }

        $this->httpRequest->setAttribute('controller', $route->getController());
        $this->httpRequest->setAttribute('action', $route->getAction());

        $container->get(EventsListenerInterface::class)->trigger('route.found', $this->httpRequest);
    }

    /**
     * @param ContainerInterface $container
     *
     * @return ServerMessageInterface
     *
     * @throws \ReflectionException
     */
    protected function processResponse(ContainerInterface $container): ServerMessageInterface
    {
        $reflection = new ReflectionClass($this->httpRequest->getAttribute('controller'));

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

        return $controller->{$this->httpRequest->getAttribute('action')}($this->httpRequest);
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
            if ($providerInstance instanceof RoutesProviderInterface) {
                $providerInstance->setupRoutes($container->get(RouterInterface::class));
            }

            if ($providerInstance instanceof EventsProviderInterface) {
                $providerInstance->registerEvents($container->get(EventsListenerInterface::class));
            }
        }
    }
}
