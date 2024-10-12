<?php declare(strict_types=1);

namespace App\Cms\Http;

use App\Common\Http\Protocol\ServerMessageInterface;
use App\Common\Http\ServerInterface;

final class Server implements ServerInterface
{
    public function sendMessage(ServerMessageInterface $message): void
    {
        if (headers_sent()) {
            return;
        }
        
        foreach ($message->getHeaders() as $header => $value) {
            header(sprintf('%s: %s', $header, $value), true);
        }
        
        header(sprintf('%s %d %s', 'HTTP/1.1', $message->getStatusCode(), 'Some Status Message'));
        
        echo $message->getBody();
    }
}
