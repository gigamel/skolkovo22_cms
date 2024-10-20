<?php declare(strict_types=1);

namespace App\Controller;

use Sklkv22\Http\Protocol\ClientMessageInterface;
use Sklkv22\Http\Protocol\ServerMessageInterface;
use Sklkv22\Http\ServerMessage;

final class ContactsController
{
    public function __invoke(ClientMessageInterface $clientMessage): ServerMessageInterface
    {
        return new ServerMessage(
            theme(
                'contacts.php',
                [
                    'clientMessage' => $clientMessage,
                ]
            )
        );
    }
}
