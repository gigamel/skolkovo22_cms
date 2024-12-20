<?php

declare(strict_types=1);

namespace App\Controller\Admin\Complexe;

use App\Base\View\WidgetCompositeInterface;
use App\Service\Complex\ComplexRepository;
use Gigamel\Frontend\View\RenderCompositeInterface;
use Gigamel\Http\Protocol\ClientMessageInterface;
use Gigamel\Http\Protocol\ServerMessageInterface;
use Gigamel\Http\ServerMessage;

final class ListController
{
    public function __construct(
        private readonly ComplexRepository $repository,
        private readonly RenderCompositeInterface $renderComposite,
        private readonly WidgetCompositeInterface $widget
    ) {
    }

    public function __invoke(ClientMessageInterface $message): ServerMessageInterface
    {
        $page = $message->getSegment('page') ?? 1;

        return new ServerMessage(
            $this->renderComposite->render(
                'admin.php',
                [
                    'content' => $this->renderComposite->render(
                        'complex/list.php',
                        [
                            'complexes' => $this->repository->getList(3, $page),
                            'all' => $this->repository->getCount(),
                            'currentPage' => $page,
                            'widget' => $this->widget,
                            'currentPath' => $message->getPath(),
                        ]
                    ),
                ]
            )
        );
    }
}
