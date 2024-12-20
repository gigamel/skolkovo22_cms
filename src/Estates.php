<?php

declare(strict_types=1);

namespace App;

use App\Base\Argument\ConstructorParser;
use App\Base\Core;
use App\Base\Import\PhpArrayImporter;
use App\Base\Service\ContainerableInterface;
use App\Base\Service\ObservableInterface;
use App\Controller\PageController;
use App\Event\BeforeRoutingEvent;
use App\Event\RoutesCollectionEvent;
use App\Event\RouteFoundEvent;
use Gigamel\Http\ClientMessage;
use Gigamel\Http\HttpExceptionInterface;
use Gigamel\Http\Protocol\ClientMessageInterface;
use Gigamel\Http\Protocol\ServerMessageInterface;
use Gigamel\Http\Route;
use Gigamel\Http\Router;
use Gigamel\Http\Router\RoutesCollectionInterface;
use Gigamel\Http\RoutesCollection;
use Gigamel\Http\Server;
use Gigamel\Http\ServerMessage;
use Gigamel\Import\ImportableInterface;
use Throwable;

use function class_exists;

final class Estates
{
    private ImportableInterface $importer;

    private Core $core;

    private ConstructorParser $parser;

    public function __construct(
        string $path
    ) {
        $this->importer = new PhpArrayImporter($path . '/config');
        $this->core = new Core();
    }

    public function run(): void
    {
        $clientMessage = new ClientMessage();

        try {
            $this->boostrap();
            $serverMessage = $this->handleClientMessage($clientMessage);
        } catch (Throwable $e) {
            $serverMessage = $this->handleThrowable($e);
        }

        if ($serverMessage instanceof ServerMessageInterface) {
            (new Server())->sendMessage($serverMessage);
        } else {
            $this->handleUnknownError($serverMessage);
        }
    }

    private function handleClientMessage(ClientMessageInterface $message): ServerMessageInterface
    {
        $event = new BeforeRoutingEvent($message);

        $this->core->getEventsObserver()->observe($event);
        if ($event->hasServerMessage()) {
            return $event->getServerMessage();
        }

        $routesCollection = $this->buildRoutesCollection();
        $event = new RoutesCollectionEvent($message, $routesCollection);
        $this->core->getEventsObserver()->observe($event);

        $routeShard = (new Router($routesCollection))->handleClientMessage($message);
        $event = new RouteFoundEvent($message, $routeShard);

        $this->core->getEventsObserver()->observe($event);
        $routeShard = $event->getRouteShard();

        foreach ($routeShard->getSegments() as $id => $segment) {
            $message->setSegment($id, $segment);
        }

        $controller = $this->makeController($routeShard->getHandler());
        return $controller($message);
    }

    private function handleThrowable(Throwable $e): mixed
    {
        if ($e instanceof HttpExceptionInterface) {
            return new ServerMessage(
                $e->getMessage(),
                $e->getCode(),
                $e->getHeaders()
            );
        }

        return $e;
    }

    private function handleUnknownError(mixed $serverMessage): void
    {
        echo sprintf('<pre>%s</pre>', var_export($serverMessage, true));
    }

    private function boostrap(): void
    {
        $this->loadContainer();
        $this->loadObservers();
        $this->loadProviders();
    }

    private function loadContainer(): void
    {
        $this->core->getContainer()->importArguments('../config/arguments.php');
        foreach ($this->importer->import('container.php') as $id => $service) {
            $this->core->getContainer()->set($id, $service);
        }
    }

    private function loadObservers(): void
    {
        $this->core->getEventsObserver()->setObserverParser($this->getArgumentsParser());
        foreach ($this->importer->import('observers.php') as $event => $observers) {
            foreach ($observers as $observer) {
                $this->core->getEventsObserver()->addObserver($event, $observer);
            }
        }
    }

    private function loadProviders(): void
    {
        foreach ($this->importer->import('providers.php') as $provider) {
            $this->makeProvider($provider);
        }
    }

    private function buildRoutesCollection(): RoutesCollectionInterface
    {
        $routesCollection = new RoutesCollection();
        $routesCollection->add(...$this->importer->import('routes.php'));
        return $routesCollection;
    }

    private function makeProvider(string $class): void
    {
        if (!class_exists($class)) {
            return;
        }

        $provider = new $class();
        if ($provider instanceof ObservableInterface) {
            $provider->addObservers($this->core->getEventsObserver());
        }

        if ($provider instanceof ContainerableInterface) {
            $provider->setupContainer($this->core->getContainer());
        }
    }

    private function makeController(string $class): object
    {
        $controllerArguments = $this->getArgumentsParser()->getArguments($class);
        return $this->core->getContainer()->newInstance($class, $controllerArguments);
    }

    private function getArgumentsParser(): ConstructorParser
    {
        return $this->parser ??= new ConstructorParser($this->core->getContainer());
    }
}
