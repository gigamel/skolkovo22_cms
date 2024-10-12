<?php declare(strict_types=1);

namespace App;

use App\Cms\ArgumentsParser;
use App\Cms\DI\Container;
use App\Cms\DI\ContainerInterface;
use App\Cms\Http\Server;
use App\Common\Http\ClientMessage;
use App\Common\Http\Router;
use App\Common\Http\Routing\RouterInterface;
use App\Common\Http\ThrowableHandler;
use App\Service\Blog\PostRepository;
use App\Service\Catalog\ProductRepository;
use App\Service\User\UserRepository;
use Throwable;

final class CmsApplication
{
    private bool $isRunning = false;
    
    private ContainerInterface $container;
    
    private ?RouterInterface $router = null;
    
    public function __construct(?ContainerInterface $container = null)
    {
        $this->container = $container ?? new Container();
    }
    
    public function run(): void
    {
        if ($this->isRunning) {
            return;
        }
        
        $this->isRunning = true;
        
        try {
            $this->container->put(UserRepository::class);
            $this->container->put(ProductRepository::class);
            $this->container->put(PostRepository::class);
            
            $this->runCms();
        } catch (Throwable $e) {
            echo sprintf('<pre>%s</pre>', var_export($e, true));
            
            (new ThrowableHandler())->handle($e);
        }
    }
    
    private function runCms(): void
    {
        $router = $this->getRouter();
        
        $clientMessage = new ClientMessage();
        
        $handled = $router->handleClientMessage($clientMessage);
        [$controllerClass, $actionName] = explode('::', $handled);
        
        $parser = (new ArgumentsParser($this->container, $clientMessage));
        
        $controllerArguments = $parser->getConstructorArguments($controllerClass);
        $controller = new $controllerClass(...$controllerArguments);
        
        $actionArguments = $parser->getActionArguments($controller, $actionName);
        $serverMessage = $controller->{$actionName}(...$actionArguments);
        
        (new Server())->sendMessage($serverMessage);
    }
    
    private function getRouter(): RouterInterface
    {
        if (null !== $this->router) {
            return $this->router;
        }
        
        return $this->router = new Router(
            require_once(__DIR__ . '/../config/routes.php'),
            [
                'id' => '[1-9]+[0-9]?',
                'page' => '[1-9]+[0-9]?',
            ]
        );
    }
}
