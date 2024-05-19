<?php

declare(strict_types=1);

namespace App\Common\Http;

use App\Framework\Http\Error\ThrowableHandlerInterface;
use Exception;
use Throwable;

class ThrowableHandler implements ThrowableHandlerInterface
{
    /**
     * @param Throwable $e
     *
     * @return void
     */
    public function handle(Throwable $e): void
    {
        if ($e instanceof Exception) {
            $handler = new ExceptionHandler();
        } else {
            $handler = new ErrorHandler();
        }
        
        $httpResponse = $handler->handle($e);
        $httpResponse->send();
        echo $httpResponse->getBody();
    }
}
