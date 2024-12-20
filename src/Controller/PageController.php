<?php

declare(strict_types=1);

namespace App\Controller;

use Gigamel\Frontend\View\RenderCompositeInterface;
use Gigamel\Http\Protocol\ClientMessageInterface;
use Gigamel\Http\Protocol\ServerMessageInterface;
use Gigamel\Http\ServerMessage;
use Gigamel\Http\Server\SessionInterface;

final class PageController
{
    public function __construct(
        private readonly RenderCompositeInterface $renderComposite,
        private SessionInterface $session
    ) {
    }

    public function __invoke(ClientMessageInterface $message): ServerMessageInterface
    {
        return new ServerMessage(
            $this->renderComposite->render(
                'site.php',
                [
                    'content' => '<h1>Hello world!</h1>',
                ]
            )
        );
    }
}
