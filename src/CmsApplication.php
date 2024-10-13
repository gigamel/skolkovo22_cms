<?php declare(strict_types=1);

namespace App;

use App\Cms\ArgumentsParser;
use App\Cms\BusinessRules\ActionResultRules;
use App\Cms\BusinessRules\ActionRules;
use App\Cms\BusinessRules\ControllerRules;
use App\Cms\Core;
use App\Cms\CoreInterface;
use App\Cms\Http\Server;
use App\Common\Http\ClientMessage;
use App\Common\Http\Router;
use App\Common\Http\Routing\RouterInterface;
use App\Common\Http\Protocol\ClientMessageInterface;
use App\Common\Http\Protocol\ServerMessageInterface;
use App\Service\Blog\PostRepository;
use App\Service\Catalog\ProductRepository;
use App\Service\User\UserRepository;
use Throwable;

final class CmsApplication
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
        
        $this->checkControllerBusinessRules($controllerClass, $actionName);
        $this->checkActionBusinessRules($controllerClass, $actionName);
        
        $parser = (new ArgumentsParser($this->core->getContainer(), $clientMessage));
        
        $controllerArguments = $parser->getConstructorArguments($controllerClass);
        $controller = new $controllerClass(...$controllerArguments);
        
        $actionArguments = $parser->getActionArguments($controller, $actionName);
        $serverMessage = $controller->{$actionName}(...$actionArguments);
        $this->checkActionResultBusinessRules($controllerClass, $actionName, $serverMessage);
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
    
    private function checkControllerBusinessRules(string $controller, string $action): void
    {
        $controllerRules = new ControllerRules();
        foreach ($this->getControllerRules() as $rule) {
            $controllerRules->addRule($rule);
        }
        $controllerRules->check($controller);
    }
    
    private function checkActionBusinessRules(string $controller, string $action): void
    {
        $actionRules = new ActionRules();
        foreach ($this->getActionRules() as $rule) {
            $actionRules->addRule($rule);
        }
        $actionRules->check($controller, $action);
    }
    
    private function checkActionResultBusinessRules(
        string $controller,
        string $action,
        mixed $result
    ): void {
        $actionResultRules = new ActionResultRules();
        foreach ($this->getActionResultRules() as $rule) {
            $actionResultRules->addRule($rule);
        }
        $actionResultRules->check($controller, $action, $result);
    }
    
    private function registerCommonDependenies(): void
    {
        $this->core->getContainer()->put(UserRepository::class);
        $this->core->getContainer()->put(ProductRepository::class);
        $this->core->getContainer()->put(PostRepository::class);
    }
    
    private function getControllerRules(): array
    {
        return [
            new \App\Cms\BusinessRules\Routing\Controller\NameRule(),
            new \App\Cms\BusinessRules\Routing\Controller\ModifiersRule(),
            new \App\Cms\BusinessRules\Routing\Controller\InstanceofRule(),
            new \App\Cms\BusinessRules\Routing\Controller\ConstructorRule(),
        ];
    }
    
    private function getActionRules(): array
    {
        return [
            new \App\Cms\BusinessRules\Routing\Action\ModifiersRule(),
            new \App\Cms\BusinessRules\Routing\Action\NameRule(),
        ];
    }
    
    private function getActionResultRules(): array
    {
        return [
            new \App\Cms\BusinessRules\Routing\ActionResult\ServerMessageRule(),
        ];
    }
}
