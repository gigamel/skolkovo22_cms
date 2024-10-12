<?php declare(strict_types=1);

namespace App\Cms\Http\Controller;

use App\Common\Http\Protocol\ServerMessageInterface;
use App\Common\Http\ServerMessage;

abstract class AbstractController
{
    final protected function createServerMessage(
        string $body = '',
        int $statusCode = ServerMessageInterface::STATUS_OK,
        array $headers = []
    ): ServerMessageInterface {
        return new ServerMessage($body, $statusCode, $headers);
    }
    
    final protected function render(
        string $view,
        array $vars = [],
        int $statusCode = ServerMessageInterface::STATUS_OK,
        array $headers = []
    ): ServerMessageInterface {
        if (!str_ends_with($view, '.php') || !file_exists($view)) {
            return $this->createServerMessage('', $statusCode, $headers);
        }
        
        extract($vars);
        unset($vars);
        
        ob_start();
        require $view;
        $body = ob_get_contents();
        ob_end_clean();
        
        return $this->createServerMessage($body, $statusCode, $headers);
    }
}
