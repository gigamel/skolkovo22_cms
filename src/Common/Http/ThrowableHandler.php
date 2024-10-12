<?php declare(strict_types=1);

namespace App\Common\Http;

use App\Common\Http\ServerMessage;
use App\Common\Http\Protocol\ServerMessageInterface;
use App\Common\Http\Throwable\ThrowableHandlerInterface;
use Throwable;

class ThrowableHandler implements ThrowableHandlerInterface
{
    public function handle(Throwable $e): void
    {
        if ($e instanceof HttpException) {
            $serverMessage = new ServerMessage(
                $e->getMessage(),
                $e->getCode()
            );
        } else {
            $serverMessage = new ServerMessage(
                ServerMessageInterface::MESSAGES[ServerMessageInterface::STATUS_INTERNAL_SERVER_ERROR],
                ServerMessageInterface::STATUS_INTERNAL_SERVER_ERROR
            );
        }
        
        $serverMessage->send();
        
        echo $serverMessage->getBody();
    }
}
