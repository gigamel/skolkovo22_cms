<?php

declare(strict_types=1);

namespace App\Admin\Common;

use App\Common\Base\Directory;
use App\Framework\Http\Protocol\ServerMessageInterface;
use App\Framework\Http\Response;
use App\Framework\Http\Routing\RouterInterface;
use App\Framework\Render\TemplateEngineInterface;

abstract class AbstractController
{
    /** @var RouterInterface */
    protected $router;

    /**
     * @param RouterInterface $router
     *
     * @return void
     */
    final public function setRouter(RouterInterface $router): void
    {
        $this->router = $router;
    }

    /**
     * @param string $view
     * @param array $vars
     * @param int $statusCode
     * @param array $headers
     *
     * @return ServerMessageInterface
     */
    final protected function render(
        string $view,
        array $vars = [],
        int $statusCode = ServerMessageInterface::STATUS_OK,
        array $headers = []
    ): ServerMessageInterface {
        return new Response(
            $this->renderView($view, $vars),
            $statusCode,
            $headers
        );
    }

    /**
     * @param string $view
     * @param array $vars
     *
     * @return string
     */
    final protected function renderView(string $view, array $vars = []): string
    {
        $content = '';

        $file = Directory::view() . '/' . $view;
        if (file_exists($file)) {
            extract($vars);
            unset($vars);

            ob_start();
            require_once $file;
            $content = ob_get_contents();
            ob_end_clean();
        }
        
        return $content;
    }
}
