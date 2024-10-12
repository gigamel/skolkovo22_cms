<?php declare(strict_types=1);

namespace App\Cms\Http;

use App\Common\Http\Protocol\ServerMessageInterface;

final class Server
{
    public function sendMessage(ServerMessageInterface $message): void
    {
        $message->send();
        
        echo $message->getBody();
    }
}
