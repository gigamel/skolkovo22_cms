<?php

declare(strict_types=1);

namespace App\Service\Auth\Controller;

use Gigamel\Frontend\View\RenderCompositeInterface;
use Gigamel\Http\Protocol\ClientMessageInterface;
use Gigamel\Http\Protocol\ClientMessage\Method;
use Gigamel\Http\Protocol\ServerMessageInterface;
use Gigamel\Http\ServerMessage;
use Gigamel\Http\Server\SessionInterface;

final class LogoutController
{
    public function __construct(
        private SessionInterface $session,
        private RenderCompositeInterface $renderComposite
    ) {
    }

    public function __invoke(ClientMessageInterface $message): ServerMessageInterface
    {
        if (Method::POST === $message->getMethod()) {
            $this->session->remove('is_auth', '1');

            return new ServerMessage(
                'Movement',
                302,
                [
                    'Location' => '/',
                ]
            );
        }

        return new ServerMessage(
            $this->renderComposite->render('logout.php')
        );
    }
}
