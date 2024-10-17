<?php declare(strict_types=1);

namespace App\Controller;

use Skolkovo22\Http\Protocol\ClientMessageInterface;
use Skolkovo22\Http\Protocol\ServerMessageInterface;
use Skolkovo22\Http\ServerMessage;

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
