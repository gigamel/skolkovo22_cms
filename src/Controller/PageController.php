<?php declare(strict_types=1);

namespace App\Controller;

use App\Common\Http\Protocol\ClientMessageInterface;
use App\Common\Http\Protocol\ServerMessageInterface;
use App\Common\Http\ServerMessage;

final class PageController
{
    public function contacts(ClientMessageInterface $clientMessage): ServerMessageInterface
    {
        return new ServerMessage(
            render(
                'contacts.php',
                [
                    'clientMessage' => $clientMessage,
                ]
            )
        );
    }
}
