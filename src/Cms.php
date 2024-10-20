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
use App\Common\Config\ProviderImporter;
use App\Common\Config\RoutesImporter;
use Sklkv22\Http\ClientMessage;
use Sklkv22\Http\Router\CollectionInterface;
use Sklkv22\Http\Router\RouteInterface;
use Sklkv22\Http\Router\RouterInterface;
use Sklkv22\Http\Protocol\ClientMessageInterface;
use Sklkv22\Http\Protocol\ServerMessageInterface;
use RuntimeException;
use Throwable;

final class Cms
{
    private bool $isRunning = false;
    
    private readonly string $provider;
    
    private CoreInterface $core;
    
    private ?RouterInterface $router = null;
    
    private float $startTime;
    
    public function __construct(
        private ProjectInterface $project,
        ?string $provider = null,
        ?CoreInterface $core = null
    ) {
        $this->core = $core ?? new Core();
        $this->provider = $provider ?? \App\Common\Provider::class;
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
        if (!$this->isCorrectProviderInterface($this->provider)) {
            throw new RuntimeException('Common provider does not exists.');
        }
        
        $this->core->getContainer()->newInstance($this->provider)->setup($this->core->getContainer());

        (new ProviderImporter($this->project))->import($this->core->getContainer());
        (new RoutesImporter($this->project))->import($this->core->getContainer()->get(CollectionInterface::class));
        
        $clientMessage = new ClientMessage();
        
        $route = $this->core->getContainer()->get(RouterInterface::class)->handleClientMessage($clientMessage);

        foreach ($route->fetchSegments($clientMessage) as $id => $segment) {
            $clientMessage->setSegment($id, $segment);
        }
        
        $controllerRules = new ControllerRules($route->getHandler());
        $this->checkRules($controllerRules);
        
        $controllerArguments = (new ConstructorParser(
            $this->core->getContainer(),
            $clientMessage
        ))->getArguments($route->getHandler());
        
        $controllerClass = $route->getHandler();
        $controller = new $controllerClass(...$controllerArguments);
        
        $actionArguments = (new ActionParser(
            $this->core->getContainer(),
            $clientMessage
        ))->getArguments($route->getHandler(), '__invoke');
        
        $serverMessage = $controller(...$actionArguments);
        
        $serverMessage->addHeader(
            'X-App-Time',
            (string) (microtime(true) - $this->startTime)
        );
        
        (new Server())->sendMessage($serverMessage);
    }
    
    private function checkRules(RulesInterface $rules): void
    {
        $this->core->getContainer()->get(RulesCheckerInterface::class)->check($rules);
    }
    
    private function isCorrectProviderInterface(string $class): bool
    {
        return class_exists($class) && is_subclass_of($class, ProviderInterface::class);
    }
}
