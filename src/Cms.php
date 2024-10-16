<?php declare(strict_types=1);

namespace App;

use App\Cms\Arguments\ActionParser;
use App\Cms\Arguments\ConstructorParser;
use App\Cms\BusinessRules\ActionResultRules;
use App\Cms\BusinessRules\ActionRules;
use App\Cms\BusinessRules\RulesCheckerInterface;
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
    
    private function runCms(): void
    {        
        $this->providers[] = new \App\Provider\CommonProvider();
        $this->providers[] = new \App\Provider\BlogProvider();
        $this->providers[] = new \App\Provider\CatalogProvider();
        $this->providers[] = new \App\Provider\UserProvider();
        
        foreach ($this->providers as $provider) {
            $provider->setup($this->core->getContainer());
        }
        
        foreach (require_once(__DIR__ . '/../config/routes.php') as $route) {
            $this->core->getContainer()->get(RoutesCollectionInterface::class)->set(...array_values($route));
        }
        
        $clientMessage = new ClientMessage();
        
        $route = $this->core->getContainer()->get(RouterInterface::class)->handleClientMessage($clientMessage);
        
        $controllerRules = new ControllerRules($route->getController());
        $this->core->getContainer()->get(RulesCheckerInterface::class)->check($controllerRules);
        
        $actionRules = new ActionRules($route->getController(), $route->getAction());
        $this->core->getContainer()->get(RulesCheckerInterface::class)->check($actionRules);
        
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
        
        $serverMessage = $controller->{$route->getAction()}(...$actionArguments);
        
        (new Server())->sendMessage($serverMessage);
    }
}
