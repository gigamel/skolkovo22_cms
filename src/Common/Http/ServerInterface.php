<?php declare(strict_types=1);

namespace App\Common\Http;

use App\Common\Http\Protocol\ServerMessageInterface;

interface ServerInterface
{
    public function sendMessage(ServerMessageInterface $message): void;
}
