<?php declare(strict_types=1);

namespace App;

use App\Cms\Arguments\ActionParser;
use App\Cms\Arguments\ConstructorParser;
use App\Cms\BusinessRules\ActionResultRules;
use App\Cms\BusinessRules\ActionRules;
use App\Cms\BusinessRules\RulesChecker;
use App\Cms\BusinessRules\RulesInterface;
use App\Cms\BusinessRules\ControllerRules;
use App\Cms\Core;
use App\Cms\CoreInterface;
use App\Cms\DI\ProviderInterface;
use App\Cms\Http\Server;
use App\Common\Http\ClientMessage;
use App\Common\Http\Routing\RoutesCollectionInterface;
use App\Common\Http\Routing\RouteInterface;
use App\Common\Http\Routing\RouterInterface;
use App\Common\Http\Protocol\ClientMessageInterface;
use App\Common\Http\Protocol\ServerMessageInterface;
use Throwable;

final class Cms
{
    private bool $isRunning = false;
    
    private CoreInterface $core;
    
    private ?RouterInterface $router = null;
    
    /** @var list<ProviderInterface> */
    private array $providers = [];
    
    public function __construct(?CoreInterface $core = null)
    {
        $this->core = $core ?? new Core();
    }
    
    public function run(): void
    {
        if ($this->isRunning) {
            return;
        }
        
        $this->isRunning = true;
        
        try {
            $this->runCms();
        } catch (Throwable $e) {
            echo sprintf('<pre>%s</pre>', var_export($e, true));
        }
    }
    
    public function registerProvider(ProviderInterface $provider): self
    {
        $this->providers[] = $provider;
        return $this;
    }
    
    public function addRoute(string $name, RouteInterface $route): void
    {
        $this->core->getContainer()->get(RoutesCollectionInterface::class)->set($name, $route);
    }
    
    private function runCms(): void
    {
        $this
            ->registerProvider(new \App\Provider\CommonProvider())
            ->registerProvider(new \App\Provider\BlogProvider())
            ->registerProvider(new \App\Provider\CatalogProvider())
            ->registerProvider(new \App\Provider\UserProvider());
        
        $this->setupProviders();
        $this->setupRoutes();
        
        $clientMessage = new ClientMessage();
        
        $route = $this->getRoute($clientMessage);
        
        $this->checkRoute($route);
        
        $serverMessage = $this->getServerMessage($clientMessage, $route);
        
        $this->serverSendMessage($serverMessage);
    }
    
    private function getRoute(ClientMessageInterface $clientMessage): RouteInterface
    {
        return $this->core->getContainer()->get(RouterInterface::class)->handleClientMessage($clientMessage);
    }
    
    private function checkRoute(RouteInterface $route): void
    {
        (new RulesChecker())->check(new ControllerRules($route->getController()));
        (new RulesChecker())->check(new ActionRules($route->getController(), $route->getAction()));
    }
    
    private function getServerMessage(
        ClientMessageInterface $clientMessage,
        RouteInterface $route
    ): ServerMessageInterface {
        $controllerArguments = (new ConstructorParser(
            $this->core->getContainer(),
            $clientMessage
        ))->getArguments($route->getController());
        
        $controllerClass = $route->getController();
        $controller = new $controllerClass(...$controllerArguments);
        
        $actionArguments = (new ActionParser(
            $this->core->getContainer(),
            $clientMessage
        ))->getArguments($route->getController(), $route->getAction());
        
        return $controller->{$route->getAction()}(...$actionArguments);
    }
    
    private function serverSendMessage(ServerMessageInterface $message): void
    {
        (new Server())->sendMessage($message);
    }
    
    private function setupProviders(): void
    {
        foreach ($this->providers as $provider) {
            $provider->setup($this->core->getContainer());
        }
    }
    
    private function setupRoutes(): void
    {
        foreach (require_once(__DIR__ . '/../config/routes.php') as $route) {
            $this->addRoute(...array_values($route));
        }
    }
}
