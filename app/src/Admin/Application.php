<?php

declare(strict_types=1);

namespace App\Admin;

use App\Common\Base\Directory;
use App\Common\Http\ExceptionHandler;
use App\Common\Render\TemplateEngine;
use App\Framework\Http\Request;
use App\Framework\Http\Routing\RouterInterface;
use Throwable;

class Application
{
    /**
     * @return void
     */
    public function run(): void
    {
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
        $router = $this->loadRouter();
        
        $request = new Request();
        $route = $router->handle($request);

        $controllerName = $route->getController();
        $controller = new $controllerName();
        
        $response = $controller->{$route->getAction()}($request);
        $response->send();
        
        $templateEngine = new TemplateEngine(Directory::theme());
        $templateEngine->setContent($response->getBody());
        $templateEngine->includeTheme('admin');
    }
    
    /**
     * @param Throwable $e
     *
     * @return void
     */
    protected function processThrowable(Throwable $e): void
    {
        if ($e instanceof \Exception) {
            $response = (new ExceptionHandler())->handle($e);
            $response->send();
            echo $response->getBody();
        } else {
            echo sprintf('<pre style="padding:15px;background-color:purple;color:#eee;">%s [%s]</pre>', $e->getMessage(), get_class($e));
            echo sprintf('<pre style="padding:15px;background-color:#eee;border:1px solid purple;">%s</pre>', $e->getTraceAsString());
        }
    }
    
    /**
     * @return RouterInterface
     */
    protected function loadRouter(): RouterInterface
    {
        return require_once(Directory::config() . '/admin/routes.php');
    }
}
