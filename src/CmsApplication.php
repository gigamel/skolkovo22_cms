<?php declare(strict_types=1);

namespace App;

use App\Cms\ArgumentsParser;
use App\Cms\BusinessRules\ActionRules;
use App\Cms\BusinessRules\ControllerRules;
use App\Cms\Config\Alias;
use App\Cms\DI\Container;
use App\Cms\DI\ContainerInterface;
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
    
    private ContainerInterface $container;
    
    private ?RouterInterface $router = null;
    
    private Alias $alias;
    
    public function __construct(?ContainerInterface $container = null)
    {
        $this->container = $container ?? new Container();
        $this->alias = new Alias();
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
        
        $this->checkActionBusinessRules($controllerClass, $actionName);
        
        $parser = (new ArgumentsParser($this->container, $clientMessage));
        
        $controllerArguments = $parser->getConstructorArguments($controllerClass);
        $controller = new $controllerClass(...$controllerArguments);
        
        $actionArguments = $parser->getActionArguments($controller, $actionName);
        return $controller->{$actionName}(...$actionArguments);
    }
    
    private function setupAliases(): void
    {
        $this->alias->set('@config', __DIR__ . '/../config');
    }
    
    private function getRouter(): RouterInterface
    {
        if (null !== $this->router) {
            return $this->router;
        }
        
        return $this->router = new Router(
            require_once($this->alias->get('@config/routes.php')),
            [
                'id' => '[1-9]+[0-9]?',
                'page' => '[1-9]+[0-9]?',
            ]
        );
    }
    
    private function checkActionBusinessRules(string $controller, string $action): void
    {
        $controllerRules = new ControllerRules();
        foreach ($this->getControllerRules() as $rule) {
            $controllerRules->addRule($rule);
        }
        $controllerRules->check($controller);
        
        $actionRules = new ActionRules();
        foreach ($this->getActionRules() as $rule) {
            $actionRules->addRule($rule);
        }
        $actionRules->check($controller, $action);
    }
    
    private function registerCommonDependenies(): void
    {
        $this->container->put(UserRepository::class);
        $this->container->put(ProductRepository::class);
        $this->container->put(PostRepository::class);
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
}
