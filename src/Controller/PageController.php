<?php declare(strict_types=1);

namespace App\Controller;

use App\Cms\Http\Controller\AbstractController;
use App\Common\Http\Protocol\ClientMessageInterface;
use App\Common\Http\Protocol\ServerMessageInterface;

final class PageController extends AbstractController
{
    public function contacts(ClientMessageInterface $clientMessage): ServerMessageInterface
    {
        return $this->render(
            __DIR__ . '/../../view/contacts.php',
            [
                'clientMessage' => $clientMessage,
            ]
        );
    }
}
