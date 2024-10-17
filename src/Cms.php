<?php declare(strict_types=1);

namespace App;

use App\Common\Arguments\ActionParser;
use App\Common\Arguments\ConstructorParser;
use App\Common\BusinessRules\ActionResultRules;
use App\Common\BusinessRules\ActionRules;
use App\Common\BusinessRules\RulesCheckerInterface;
use App\Common\BusinessRules\RulesInterface;
use App\Common\BusinessRules\ControllerRules;
use App\Common\Config\ProjectInterface;
use App\Common\Core;
use App\Common\CoreInterface;
use App\Common\DI\ProviderInterface;
use App\Common\Http\Server;
use Skolkovo22\Http\ClientMessage;
use Skolkovo22\Http\Routing\RoutesCollectionInterface;
use Skolkovo22\Http\Routing\RouteInterface;
use Skolkovo22\Http\Routing\RouterInterface;
use Skolkovo22\Http\Protocol\ClientMessageInterface;
use Skolkovo22\Http\Protocol\ServerMessageInterface;
use Throwable;

final class Cms
{
    private bool $isRunning = false;
    
    private CoreInterface $core;
    
    private ?RouterInterface $router = null;
    
    private float $startTime;
    
    public function __construct(
        private ProjectInterface $project,
        ?CoreInterface $core = null
    ) {
        $this->core = $core ?? new Core();
        $this->startTime = microtime(true);
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
        foreach (require_once($this->project->getConfigDir() . '/modules.php') as $provider) {
            if (class_exists($provider) && is_subclass_of($provider, ProviderInterface::class)) {
                (new $provider())->setup($this->core->getContainer());
            }
        }
        
        foreach (require_once($this->project->getConfigDir() . '/routes.php') as $name => $route) {
            $this->core->getContainer()->get(RoutesCollectionInterface::class)->set($name, $route);
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
        
        $serverMessage->addHeader(
            'X-App-Time',
            (string) (microtime(true) - $this->startTime)
        );
        
        (new Server())->sendMessage($serverMessage);
    }
}
