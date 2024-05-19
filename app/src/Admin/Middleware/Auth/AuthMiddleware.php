<?php

declare(strict_types=1);

namespace App\Admin\Middleware\Auth;

use App\Admin\Middleware\AbstractMiddleware;
use App\Framework\Http\Protocol\ClientMessageInterface;
use App\Framework\Http\Protocol\ServerMessageInterface;
use App\Framework\Http\Response;

class AuthMiddleware extends AbstractMiddleware
{
    /**
     * @param ClientMessageInterface $request
     * @param callable $middleware
     *
     * @return ServerMessageInterface
     */
    public function handle(ClientMessageInterface $request, callable $middleware): ServerMessageInterface
    {
        if ($request->hasAttribute('authorized')) {
            return $middleware($request);
        }
        
        if (ClientMessageInterface::METHOD_POST === $request->getMethod()) {
            setcookie('authorized', '1', 0, '/');
            return new Response(
                'AUTHORIZED',
                302,
                ['Location' => './']
            );
        }
        
        ob_start();
        require_once __DIR__ . '/view/form.php';
        $body = ob_get_contents();
        ob_end_clean();
        
        return new Response($body);
    }
}
