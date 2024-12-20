<?php

declare(strict_types=1);

namespace App\Service\Auth\Controller;

use Gigamel\Frontend\View\RenderCompositeInterface;
use Gigamel\Http\Protocol\ClientMessageInterface;
use Gigamel\Http\Protocol\ClientMessage\Method;
use Gigamel\Http\Protocol\ServerMessageInterface;
use Gigamel\Http\ServerMessage;
use Gigamel\Http\Server\SessionInterface;

final class LoginController
{
    public function __construct(
        private SessionInterface $session,
        private RenderCompositeInterface $renderComposite
    ) {
    }

    public function __invoke(ClientMessageInterface $message): ServerMessageInterface
    {
        if (Method::POST === $message->getMethod() && $this->isAuthorizated()) {
            $this->session->set('is_auth', '1');
        }

        if ($this->session->exists('is_auth')) {
            return new ServerMessage(
                'Movement',
                302,
                [
                    'Location' => $message->getPath(),
                ]
            );
        }

        return new ServerMessage(
            $this->renderComposite->render('login.php')
        );
    }

    private function isAuthorizated(): bool
    {
        return 'admin' === ($_POST['login'] ?? null) && '123' === ($_POST['password'] ?? null);
    }
}
