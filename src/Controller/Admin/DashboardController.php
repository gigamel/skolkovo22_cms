<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use Gigamel\Frontend\View\RenderCompositeInterface;
use Gigamel\Http\Protocol\ClientMessageInterface;
use Gigamel\Http\Protocol\ServerMessageInterface;
use Gigamel\Http\ServerMessage;
use Gigamel\Http\Server\SessionInterface;

final class DashboardController
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
                'admin.php',
                [
                    'content' => '<h1>Dashboard</h1>',
                ]
            )
        );
    }
}
