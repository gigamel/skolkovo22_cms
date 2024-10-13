<?php declare(strict_types=1);

namespace App;

use App\Cms\ArgumentsParser;
use App\Cms\BusinessRules\ActionResultRules;
use App\Cms\BusinessRules\ActionRules;
use App\Cms\BusinessRules\RulesChecker;
use App\Cms\BusinessRules\RulesInterface;
use App\Cms\BusinessRules\ControllerRules;
use App\Cms\Core;
use App\Cms\CoreInterface;
use App\Cms\Http\Server;
use App\Common\Http\ClientMessage;
use App\Common\Http\Router;
use App\Common\Http\Routing\RouterInterface;
use App\Common\Http\Protocol\ClientMessageInterface;
use App\Common\Http\Protocol\ServerMessageInterface;
use Throwable;

final class Cms
{
    private bool $isRunning = false;
    
    private CoreInterface $core;
    
    private ?RouterInterface $router = null;
    
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
        $this->setupAliases();
        
        $this->registerCommonDependenies();
        
        $clientMessage = new ClientMessage();
        
        $serverMessage = $this->getServerMessage($clientMessage);
        
        (new Server())->sendMessage($serverMessage);
    }
    
    private function getServerMessage(ClientMessageInterface $clientMessage): ServerMessageInterface
    {
        $handled = $this->getRouter()->handleClientMessage($clientMessage);
        [$controllerClass, $actionName] = explode('::', $handled);
        
        $this->checkRules(new ControllerRules($controllerClass));
        $this->checkRules(new ActionRules($controllerClass, $actionName));
        
        $parser = (new ArgumentsParser($this->core->getContainer(), $clientMessage));
        
        $controllerArguments = $parser->getConstructorArguments($controllerClass);
        $controller = new $controllerClass(...$controllerArguments);
        
        $actionArguments = $parser->getActionArguments($controller, $actionName);
        $serverMessage = $controller->{$actionName}(...$actionArguments);
        
        $this->checkRules(new ActionResultRules($controllerClass, $actionName, $serverMessage));
        
        return $serverMessage;
    }
    
    private function setupAliases(): void
    {
        $this->core->setAlias('@config', __DIR__ . '/../config');
    }
    
    private function getRouter(): RouterInterface
    {
        if (null !== $this->router) {
            return $this->router;
        }
        
        return $this->router = new Router(
            require_once($this->core->getAlias('@config/routes.php')),
            [
                'id' => '[1-9]+[0-9]?',
                'page' => '[1-9]+[0-9]?',
            ]
        );
    }
    
    private function registerCommonDependenies(): void
    {
        $this->core->getContainer()->put(\App\Service\Blog\PostRepository::class);
        $this->core->getContainer()->put(\App\Service\Catalog\ProductRepository::class);
        $this->core->getContainer()->put(\App\Service\User\UserRepository::class);
    }
    
    private function checkRules(RulesInterface $rules): void
    {
        (new RulesChecker())->check($rules);
    }
}
